<?php
require_once '../connection/Database.php';

$sql =
    'ALTER TABLE films
    ADD poster_url VARCHAR(255) NOT NULL;
';

$db = Database::getInstance();

echo 'Migration 004:';
$firstSuccess = $db->multi_query($sql);
if ($firstSuccess) {
    echo 'first ok' . '<br>';
}
while ($db->next_result()) {
    echo 'ok' . '<br>';
}

