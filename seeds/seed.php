<?php
require '../models/User.php';
require '../models/Film.php';

function seed_films(): void
{
    $filmsToCreate = [
        [
            'title' => 'Avengers: Infinity war',
            'genre' => 'action',
            'description' => "Lorem ipsum dolor, sit amet consectetur adipisicing elit. Nihil perspiciatis numquam itaque.",
            'release_year' => 2003,
            'trailer_url' => 'http://cdn.example.com/trailers?id=43225',
            'duration' => 104,
        ],
        [
            'title' => 'Uncharted',
            'genre' => 'adventure',
            'description' => "Lorem ipsum dolor sit amet consectetur adipisicing elit. Quos, ut. Harum, pariatur aliquid!",
            'release_year' => 2022,
            'trailer_url' => 'http://cdn.example.com/trailers?id=750',
            'duration' => 130,
        ],
        [
            'title' => 'Avengers: Endgame',
            'genre' => 'action',
            'description' => "Sit amet consectetur adipisicing elit. Nihil perspiciatis numquam itaque.",
            'release_year' => 2019,
            'trailer_url' => 'http://cdn.example.com/trailers?id=324',
            'duration' => 129,
        ]
    ];

    foreach ($filmsToCreate as $f) {
        Film::create($f);
    }
}

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
    // seed_users();
    seed_films();
    echo json_encode([
        'message' => 'Successfully seeded the database!'
    ]);
}

seed_db();