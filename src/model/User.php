<?php

namespace App\Model;

use Core\Model;

class User extends Model
{
    protected $logTimestamp = true;

    public function setPassword($password)
    {
        $this->password = password_hash($password, PASSWORD_BCRYPT);
    }
}