<?php

namespace App\Model;

use Core\Model;

class Customer extends Model
{
    protected $table = 'customer';
    protected $logTimestamp = TRUE;

    public function __construct()
    {
        parent::__construct();
    }

    public function encryptPassword($password){
        $password = password_hash($password, PASSWORD_BCRYPT);
        return $password;
    }

    
}
