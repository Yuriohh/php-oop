<?php

namespace App\Database;

use Exception;
use PDO;
use PDOException;

class Connection
{
    private static $connection = null;

    public static function connect()
    {
        try {
            if(!self::$connection) {
                self::$connection = new PDO("mysql:host=php-oop-database;dbname=rotasphpoo", "root", "root", [
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ
                ]);
            }
        } catch(PDOException $e) {
            throw new Exception("error:" . $e->getMessage());
        }

        return self::$connection;
    }
}
