<?php

namespace Core;

use PDO;
use PDOException;

abstract class Model
{
    public static function getConnection()
    {
        static $connection;

        if (! is_null($connection)) {
            return $connection;
        }
            $connection = \Config::$database_connection;
            $host = \Config::$database_host;
            $port = \Config::$database_port;
            $db = \Config::$database_name;
            $name = \Config::$database_username;
            $password = \Config::$database_password;

            $connection = new PDO("{$connection}:host={$host}:{$port};dbname={$db}", $name, $password);

            $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            return $connection;

    }
}