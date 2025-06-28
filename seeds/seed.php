<?php
require '../models/User.php';

function seed_users()
{
    $usersToCreate = [
        [
            'email' => 'admin@example.com',
            'password' => 'admin@example.com',
            'first_name' => 'Mark',
            'last_name' => 'Admin',
        ],
        [
            'email' => 'admin2@example.com',
            'password' => 'admin2@example.com',
            'first_name' => 'Mike',
            'last_name' => 'Admin',
        ],
        [
            'email' => 'user@example.com',
            'password' => 'user@example.com',
            'first_name' => 'Owen',
            'last_name' => 'User',
        ]
    ];

    foreach ($usersToCreate as $u) {
        User::create($u);
    }
}

function seed_db()
{
    seed_users();
    echo json_encode([
        'message' => 'Successfully seeded the database!'
    ]);
}

seed_db();