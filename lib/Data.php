<?php

namespace Spotlight\Data;

use PDO;

$host = getEnv('DATABASE_HOST');
$port = getEnv('DATABASE_PORT');
$db_name   = getEnv('DATABASE_NAME');
$user = getEnv('DATABASE_USER');
$pass = getEnv('DATABASE_PASSWORD');

$charset = 'utf8mb4';

$dsn = "pgsql:host=$host;dbname=$db_name;port=$port";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

$db = null;
try {
    $db = new PDO($dsn, $user, $pass, $options);
} catch (PDOException $e) {
    var_dump($e->getMessage());
};


// Bootstrap
function generate_common_columns($id_column_name = 'id') {
    $common_columns = <<<SQL
        $id_column_name SERIAL PRIMARY KEY,
        created_at TIMESTAMP WITH TIME ZONE DEFAULT CURRENT_TIMESTAMP,
        updated_at TIMESTAMP WITH TIME ZONE DEFAULT CURRENT_TIMESTAMP
    SQL;
    return $common_columns;
};

function table_exists($db, $table_name, $schema = 'public') {
    if ($db->getAttribute(PDO::ATTR_DRIVER_NAME) == "pgsql") {
        $query = <<<SQL
            SELECT COUNT(*)
            FROM information_schema.tables
            WHERE table_schema = :schema AND table_name = :table_name
        SQL;
        $stmt = $db->prepare($query);
        $stmt->execute(['schema' => $schema, 'table_name' =>$table_name]);
        $count = $stmt->fetchColumn();

        return $count > 0;
    } else {
        echo "table_exists doesn't support that SQL server.";
        return false;
    };
};

function create_role_table($db) {
    $common_columns = generate_common_columns('role_id');
    $query = <<<SQL
        CREATE TABLE role (
            $common_columns,
            role_name VARCHAR(100) NOT NULL UNIQUE,
            role_level INT NOT NULL CONSTRAINT role_level_positive CHECK (role_level > 0)
        )
    SQL;
    if (table_exists($db, "role") === false) {
        echo "role table doesn't exist, create it.\n";
        $db->query($query);
        // Add admin role
        $db->query("INSERT INTO role (role_name, role_level) VALUES ('admin', 1)");
        // Add noob role
        $db->query("INSERT INTO role (role_name, role_level) VALUES ('noob', 2)");
        echo "Role table created. Admin and Noob role created.";
    };
};

function create_superuser($db, $name, $password) {
    $query = <<<SQL
        INSERT INTO account (email, password, role_id)
        VALUES (:email, :password, :role_id)
    SQL;
    $stmt = $db->prepare($query);
    $stmt->execute(["email" => $name,
                    'password' => $password,
                    "role_id" => '1']);
    $superuser = $stmt->fetch();
    return $superuser;
};

function create_account_table($db) {
    $common_columns = generate_common_columns('account_id');
    $user_columns = <<<SQL
        CREATE TABLE account (
            $common_columns,
            email VARCHAR(255) UNIQUE,
            password TEXT,
            role_id INT REFERENCES role
        )
    SQL;
    if (table_exists($db, "account") === false) {
        $db->query($user_columns);
        $su_name = getEnv('SUPERUSER_EMAIL') ? getEnv('SUPERUSER_EMAIL') : 'admin@spotlight.com';
        $su_pass = getEnv('SUPERUSER_PASS') ? getEnv('SUPERUSER_PASS') : 'password';
        $hashed_su_pass = password_hash($su_pass, PASSWORD_DEFAULT);
        $superuser = create_superuser($db, $su_name, $hashed_su_pass);
        echo "account table created. Superuser name: $su_name. Superuser password: $su_pass";
    };
};

function create_post_table($db) {
    $common_columns = generate_common_columns('post_id');
    $stmt = <<<SQL
        CREATE TABLE post (
            $common_columns,
            author_id INT REFERENCES account,
            title VARCHAR(140),
            preview VARCHAR(280),
            body TEXT
        )
    SQL;
    if (table_exists($db, 'post') === false) {
        $db->query($stmt);
        echo "Post table created";
    };
};

function create_triggers($db) {
    $stmt1 = <<<SQL
        CREATE OR REPLACE FUNCTION update_modified_column()
        RETURNS TRIGGER AS $$
        BEGIN
            NEW.updated_at = CURRENT_TIMESTAMP;
            RETURN NEW;
        END;
        $$ LANGUAGE plpgsql;
    SQL;
    $db->query($stmt1);
    echo "update_modified_column SQL function created successfully.\n";

    $stmt2 = <<<SQL
        CREATE OR REPLACE TRIGGER update_user_modtime
        BEFORE UPDATE ON account
        FOR EACH ROW
        EXECUTE FUNCTION update_modified_column();
    SQL;
    $trigger_exists = $db->query($stmt2);
    echo "update_user_modtime trigger created successfully.\n";
};

function create_auth_tables($db) {
    $role_table_exists = table_exists($db, 'role');
    $user_table_exists = table_exists($db, 'account');
    $superuser = null;
    if ($role_table_exists === false) {
        echo "role table doesn't exist, create it.\n";
        create_role_table($db);
    };
    if ($user_table_exists === false) {
        echo "account table doesn't exist, create it.\n";
        $superuser = create_account_table($db);
    };
    return $superuser;
};

function initialize_database() {
    global $db;
    print "Initialize database.";
    try {
        $db->beginTransaction();
        $superuser = create_auth_tables($db);
        create_post_table($db);
        create_triggers($db);
        $db->commit();
    } catch (Throwable $e) {
        $e->getMessage();
        $db->rollback();
    }
    return $superuser;
};

function check_password($password) {
    global $db;
    $query = <<<SQL
        SELECT * FROM account WHERE password = ?
    SQL;

    $stmt = $db->prepare($query);

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    $stmt->execute([$hashed_password]);
    return $stmt->fetch();
};
