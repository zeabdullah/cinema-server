<?php
require_once '../connection/connection.php';

$sql =
    'CREATE TABLE IF NOT EXISTS films(
        id INT(11) AUTO_INCREMENT PRIMARY KEY,
        title VARCHAR(255) NOT NULL,
        genre VARCHAR(255) NOT NULL,
        trailer_url VARCHAR(255),
        duration INT(3) NOT NULL,
        description TEXT,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    );

    CREATE TABLE IF NOT EXISTS users(
        id INT(11) AUTO_INCREMENT PRIMARY KEY,
        email VARCHAR(255) UNIQUE NOT NULL,
        first_name VARCHAR(255) NOT NULL,
        last_name VARCHAR(255) NOT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    );
';

echo 'Migration 001:';
$firstSuccess = $mysqli->multi_query($sql);
if ($firstSuccess) {
    echo 'first ok' . '<br>';
}
while ($mysqli->next_result()) {
    echo 'ok' . '<br>';
}

