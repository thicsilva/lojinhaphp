<?php

namespace App\Model;

use Core\Model;

class Customer extends Model
{
    protected $logTimestamp = true;

    public function encryptPassword($password)
    {
        $password = password_hash($password, PASSWORD_BCRYPT);
        return $password;
    }

}
