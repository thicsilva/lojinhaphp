<?php

namespace App\Handler;

use App\Model\User;

class LoginHandler
{
    public static function checkLogin()
    {
        if (!empty($_SESSION['auth'])) {
            $token = $_SESSION['auth'];
            $user = User::all("token=$token");

            if (count($user) > 0) {
                return $user[0];
            }
        }

        return false;
    }
}
