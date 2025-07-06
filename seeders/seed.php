<?php
require 'FilmSeeder.php';
require 'UserSeeder.php';

function seed_db()
{
    // an even better refactor here would be to use autoload 'spl_autoload_register'
    FilmSeeder::seed();
    UserSeeder::seed();
    echo json_encode([
        'message' => 'Successfully seeded the database!'
    ]);
}

seed_db();