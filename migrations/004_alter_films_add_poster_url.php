<?php
require_once '../connection/connection.php';

$sql =
    'ALTER TABLE films
    ADD poster_url VARCHAR(255) NOT NULL;
';


echo 'Migration 004:';
$firstSuccess = $mysqli->multi_query($sql);
if ($firstSuccess) {
    echo 'first ok' . '<br>';
}
while ($mysqli->next_result()) {
    echo 'ok' . '<br>';
}

