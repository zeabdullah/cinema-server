<?php

class Database
{
    private static string $hostname = "localhost";
    private static string $db_name = "cinema_db";
    private static string $username = "root";
    private static ?string $password = null;

    private static mysqli $instance;

    public static function getInstance(): mysqli
    {
        if (!isset(self::$instance))
            self::$instance = new mysqli(self::$hostname, self::$username, self::$password, self::$db_name);

        return self::$instance;
    }
}