<?php
require_once '../connection/Database.php';

$sql =
    'ALTER TABLE users
    ADD password VARCHAR(255) NOT NULL;
';

$db = Database::getInstance();

echo 'Migration 002:';
$firstSuccess = $db->multi_query($sql);
if ($firstSuccess) {
    echo 'first ok' . '<br>';
}
while ($db->next_result()) {
    echo 'ok' . '<br>';
}

