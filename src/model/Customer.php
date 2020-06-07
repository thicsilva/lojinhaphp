<?php

namespace App\Model;

use Core\Model;

class Customer extends Model
{
    public function __construct()
    {
        parent::__construct();
        $this->table = 'customer';
    }
}
