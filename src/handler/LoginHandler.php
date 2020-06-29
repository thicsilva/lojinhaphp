<?php

namespace App\Handler;

use App\Model\User;

class LoginHandler
{
    public static function checkLogin()
    {
        if (!empty($_SESSION['auth'])) {
            $token = $_SESSION['auth'];
            $user = User::findFirst("token='$token'");

            if (count($user) > 0) {
                return $user[0];
            }
        }

        return false;
    }

    public static function verifyLogin($email, $password)
    {
        $user = User::findFirst("email='$email'")[0];

        if ($user) {
            if (password_verify($password, $user->password)) {

                $token = md5(microtime() . rand(0, 9999) . $user->email);
                $user->token = $token;
                $user->save();

                return $token;
            }
        }

        return false;
    }
}
