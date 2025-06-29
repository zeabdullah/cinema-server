<?php
require_once '../connection/connection.php';

$sql =
    'ALTER TABLE users
    ADD password VARCHAR(255) NOT NULL;
';

echo 'Migration 002:';
$firstSuccess = $mysqli->multi_query($sql);
if ($firstSuccess) {
    echo 'first ok' . '<br>';
}
while ($mysqli->next_result()) {
    echo 'ok' . '<br>';
}

