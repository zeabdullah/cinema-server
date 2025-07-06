<?php
require '../models/User.php';

class UserSeeder extends Seeder
{
    public static function seed(): bool
    {
        $usersToCreate = [
            [
                'email' => 'admin@example.com',
                'password' => password_hash('123456', PASSWORD_BCRYPT),
                'first_name' => 'Mark',
                'last_name' => 'Admin',
            ],
            [
                'email' => 'mike@example.com',
                'password' => password_hash('1234', PASSWORD_BCRYPT),
                'first_name' => 'Mike',
                'last_name' => 'Wallace',
            ],
            [
                'email' => 'owen@example.com',
                'password' => password_hash('pass123', PASSWORD_BCRYPT),
                'first_name' => 'Owen',
                'last_name' => 'Mann',
            ],
            [
                'email' => 'jack@example.com',
                'password' => password_hash('pass2244', PASSWORD_BCRYPT),
                'first_name' => 'Jack',
                'last_name' => 'Lars',
            ],
            [
                'email' => 'me@zabd.dev',
                'password' => password_hash('1234', PASSWORD_BCRYPT),
                'first_name' => 'Abd',
                'last_name' => 'Zeidan',
            ]
        ];

        foreach ($usersToCreate as $u) {
            User::create($u);
        }

        return true;
    }
}