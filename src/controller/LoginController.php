<?php

namespace App\Controller;

use App\Model\User;
use Core\Controller;

class LoginController extends Controller
{
    public function index()
    {        
        if (isset($_SESSION['auth'])){
            $this->redirect('/admin/home');
        }
        
        $this->render('/panel/login');
    }

    public function login()
    {
        $email = filter_input(INPUT_POST, 'email');
        $password = filter_input(INPUT_POST, 'password');        

        if (empty($email) || empty($password)){
            $_SESSION['flash'] = [
                'type'=> 'error', 
                'message'=>'Email ou senha não podem estar em branco'
            ];
            $this->redirect('/admin');
        }
        
        $user = User::all("email='$email'");

        if (empty($user)){
            $_SESSION['flash'] = [
                'type'=> 'error', 
                'message'=>'Email ou senha incorretos'
            ];
            $this->redirect('/admin');
        }

        if (!password_verify($password, $user[0]->password)){
            $_SESSION['flash'] = [
                'type'=> 'error', 
                'message'=>'Email ou senha incorretos'
            ];
            $this->redirect('/admin');
        }
        $user[0]->hash = md5(microtime() . $user[0]->email);
        $user[0]->save();
        $_SESSION['auth'] = $user[0]->hash ;

        $this->redirect('/admin/home');

    }

    public function logout()
    {
        if (isset($_SESSION['auth'])){
            unset($_SESSION['auth']);
        }

        $this->redirect('/admin');
    }
}