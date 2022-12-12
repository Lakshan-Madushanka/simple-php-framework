<?php

class Config
{
    /**
     * App
     */
     static string $environment = 'production';

    /**
     * Database configurations
     */
    static string $database_connection = 'mysqll';
    static string $database_host = 'localhost';
    static string $database_port = '3306';
    static string $database_name = 'event_management';
    static string $database_username = 'root';
    static string $database_password = '';
}