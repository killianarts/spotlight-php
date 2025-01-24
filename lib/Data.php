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

// $pdo = new PDO($dsn);

// R::setup(`postgresql:host={$host};dbname={$db}`, $user, $pass);


// Bootstrap

try {
    $test_result = $db->query('SELECT first_name FROM users');
} catch (PDOException $e) {
    $query = $db->query('CREATE TABLE users (first_name text, last_name text)');
};

function create_triggers($db) {
    try {
        $stmt1 = 'CREATE OR REPLACE FUNCTION update_modified_column()
RETURNS TRIGGER AS $$
BEGIN
    NEW.updated_at = CURRENT_TIMESTAMP;
    RETURN NEW;
END;
$$ LANGUAGE plpgsql;';

        $db->exec($stmt1);
        echo "update_modified_column SQL function created successfully.";
    } catch (PDOException $e) {
        return "Error: " . $e->getMessage();
    }

    try {
        $stmt2 = 'CREATE TRIGGER update_users_modtime
BEFORE UPDATE ON users
FOR EACH ROW
EXECUTE FUNCTION update_modified_column();';

        $db->exec($stmt2);
        echo "update_users_modtime trigger created successfully.";
    } catch (PDOException $e) {
        return "Error: " . $e->getMessage();
    }
}
