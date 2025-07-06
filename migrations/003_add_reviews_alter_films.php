<?php
require_once '../connection/Database.php';

$sql =
    'ALTER TABLE films
    ADD release_year INT(5) NOT NULL;

    CREATE TABLE IF NOT EXISTS reviews(
        id INT(11) AUTO_INCREMENT PRIMARY KEY,
        user_id INT NOT NULL,
        film_id INT NOT NULL,
        rating INT(2) NOT NULL,
        content TEXT NOT NULL,
        CONSTRAINT fk_user_on_review FOREIGN KEY (user_id) REFERENCES users(id),
        CONSTRAINT fk_film_on_review FOREIGN KEY (film_id) REFERENCES films(id)
    );
';

$db = Database::getInstance();

echo 'Migration 003:';
$firstSuccess = $db->multi_query($sql);
if ($firstSuccess) {
    echo 'first ok' . '<br>';
}
while ($db->next_result()) {
    echo 'ok' . '<br>';
}

