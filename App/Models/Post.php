<?php


namespace App\Models;

use Core\Model;
use PDO;

class Post extends Model
{
    public static function getAllPosts(): array
    {
        $connection = static::getConnection();

        $stmt = $connection->query('select * from users');

        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $results;
    }
}