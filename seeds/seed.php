<?php
require('../models/User.php');

function seed_users()
{
    $usersToCreate = [
        [
            'email' => 'admin@example.com',
            'first_name' => 'Mark',
            'last_name' => 'Admin',
        ],
        [
            'email' => 'admin2@example.com',
            'first_name' => 'Mike',
            'last_name' => 'Admin',
        ],
        [
            'email' => 'user@example.com',
            'first_name' => 'Owen',
            'last_name' => 'User',
        ]
    ];

    foreach ($usersToCreate as $u) {
        User::create($u);
    }
    echo 'Users seeding run successfully!' . '<br>';
}

function seed_db()
{
    seed_users();
    echo 'Successfully seeded the database!' . '<br>';
}

seed_db();