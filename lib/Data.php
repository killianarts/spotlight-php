<?php

// use RedBeanPHP\R as R;
$host = getEnv('DATABASE_HOST');
$port = getEnv('DATABASE_PORT');
$db   = getEnv('DATABASE_NAME');
$user = getEnv('DATABASE_USER');
$pass = getEnv('DATABASE_PASSWORD');

$charset = 'utf8mb4';

$dsn = "pgsql:host=$host;dbname=$db;port=$port";
// $dsn = "sqlite:database.db";
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
$COMMON_COLUMNS = <<<SQL
    id SERIAL PRIMARY KEY,
    created_at TIMESTAMP WITH TIME ZONE DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP WITH TIME ZONE DEFAULT CURRENT_TIMESTAMP
SQL;

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

function create_roles_table($db) {
    global $COMMON_COLUMNS;
    $query = <<<SQL
        CREATE TABLE roles (
            $COMMON_COLUMNS,
            role_name VARCHAR(100) NOT NULL UNIQUE,
            role_level INT NOT NULL CONSTRAINT role_level_positive CHECK (role_level > 0)
        )
    SQL;
    if (table_exists($db, "roles") === false) {
        echo "roles table doesn't exist, create it.\n";
        $db->query($query);
        // Add admin role
        $db->query("INSERT INTO roles (role_name, role_level) VALUES ('admin', 1)");
        // Add noob role
        $db->query("INSERT INTO roles (role_name, role_level) VALUES ('noob', 2)");
        echo "Roles table created. Admin and Noob roles created.";
    };
};

function create_superuser($db, $name, $password) {
    $query = <<<SQL
        INSERT INTO users (email, password, role_id)
        VALUES (:email, :password, :role_id)
    SQL;
    $stmt = $db->prepare($query);
    $stmt->execute(["email" => $name,
                    'password' => $password,
                    "role_id" => '1']);
    $superuser = $stmt->fetch();
    return $superuser;
};

function create_users_table($db) {
    global $COMMON_COLUMNS;
    $users_columns = <<<SQL
        CREATE TABLE users (
            $COMMON_COLUMNS,
            email VARCHAR(255) UNIQUE,
            password TEXT,
            role_id INT REFERENCES roles
        )
    SQL;
    if (table_exists($db, "users") === false) {
        $db->query($users_columns);
        $su_name = getEnv('SUPERUSER_NAME') ? getEnv('SUPERUSER_NAME') : 'admin';
        $su_pass = getEnv('SUPERUSER_PASS') ? getEnv('SUPERUSER_PASS') : 'password';
        $hashed_su_pass = password_hash($su_pass, PASSWORD_DEFAULT);
        $superuser = create_superuser($db, $su_name, $hashed_su_pass);
        echo "Users table created. Superuser name: $su_name. Superuser password: $hashed_su_pass";
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
        CREATE OR REPLACE TRIGGER update_users_modtime
        BEFORE UPDATE ON users
        FOR EACH ROW
        EXECUTE FUNCTION update_modified_column();
    SQL;
    $trigger_exists = $db->query($stmt2);
    echo "update_users_modtime trigger created successfully.\n";
};

function create_auth_tables($db) {
    $roles_table_exists = table_exists($db, 'roles');
    $users_table_exists = table_exists($db, 'users');
    $superuser = null;
    if ($roles_table_exists === false) {
        echo "roles table doesn't exist, create it.\n";
        create_roles_table($db);
    };
    if ($users_table_exists === false) {
        echo "users table doesn't exist, create it.\n";
        $superuser = create_users_table($db);
    };
    return $superuser;
};

function initialize_database($db) {
    print "Initialize database.";
    try {
        $db->beginTransaction();
        $superuser = create_auth_tables($db);
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
        SELECT * FROM users WHERE password = ?
    SQL;

    $stmt = $db->prepare($query);

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    $stmt->execute([$hashed_password]);
    return $stmt->fetch();
};
