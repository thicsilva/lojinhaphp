<?php

namespace Core;

use PDO;

class Database
{
    private static $_pdo;
    public static function getInstance()
    {
        if (!isset(self::$_pdo)) {
            self::$_pdo = new PDO("{DATABASE['db_driver']}:dbname={DATABASE['db_name']};host={DATABASE['db_host']};port={DATABASE['db_port']}", DATABASE['db_user'], DATABASE['db_password']);

        }

        return self::$_pdo;
    }
    private function __construct()
    {}
    private function __clone()
    {}
    private function __wakeup()
    {}
}
