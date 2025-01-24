<?php

require $_SERVER['DOCUMENT_ROOT']."/../start.php";
require $_SERVER['DOCUMENT_ROOT']."/../lib/Data.php";

create_triggers($db);

// Add created_at and updated_at columns, organize columns
// try {
//     $db->beginTransaction();

//     $stmt1 = 'ALTER TABLE users'
//         . ' ADD COLUMN created_at TIMESTAMP WITH TIME ZONE DEFAULT CURRENT_TIMESTAMP, '
//         . ' ADD COLUMN updated_at TIMESTAMP WITH TIME ZONE DEFAULT CURRENT_TIMESTAMP';
//     $db->exec($stmt1);

//     $stmt2 = 'CREATE TABLE users_new (id SERIAL, created_at TIMESTAMP WITH TIME ZONE DEFAULT CURRENT_TIMESTAMP, updated_at TIMESTAMP WITH TIME ZONE DEFAULT CURRENT_TIMESTAMP, first_name text, last_name text)';
//     $db->exec($stmt2);

//     $stmt3 = 'INSERT INTO users_new (id, created_at, updated_at, first_name, last_name)'
//         . ' SELECT id, created_at, updated_at, first_name, last_name FROM users';

//     $db->exec($stmt3);

//     $stmt4 = 'ALTER TABLE users RENAME TO users_backup';
//     $db->exec($stmt4);

//     $stmt5 = 'ALTER TABLE users_new RENAME TO users';
//     $db->exec($stmt5);

//     $db->commit();
//     echo "Updated users table, adding created_at and updated_at.";
// } catch (PDOException $e) {
//     $db->rollback();
//     echo 'Error: ' . $e->getMessage();
// };

// Add id column
// try {
//     $db->beginTransaction();

//     $stmt1 = 'ALTER TABLE users ADD COLUMN id SERIAL;';
//     $db->exec($stmt1);

//     $stmt2 = 'UPDATE users SET id = DEFAULT';
//     $db->exec($stmt2);

//     $stmt3 = 'ALTER TABLE users ADD CONSTRAINT users_pkey PRIMARY KEY (id)';
//     $db->exec($stmt3);

//     $db->commit();
//     echo "Updated users table successfully.";
// } catch (PDOException $e) {
//    $db->rollback();
//    echo "Error: " . $e->getMessage();
// };
