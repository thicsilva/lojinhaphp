<?php

namespace Core;

use Core\Database;

abstract class Model
{
    protected $pdo;
    public function __construct()
    {
        $this->pdo = Database::getInstance();
    }

}
