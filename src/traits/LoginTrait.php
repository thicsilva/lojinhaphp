<?php

namespace App\Traits;

trait LoginTrait {
    public function hasAuth()
    {
        if (isset($_SESSION['auth'])){
            return true;
        }

        return false;
    }
}