<?php

namespace App\Controller\Admin;

use App\Handler\LoginHandler;
use Core\Controller;

class LoginController extends Controller
{
    private $loggedUser;

    public function index()
    {
        $flash = '';
        if (!empty($_SESSION['flash'])) {
            $flash = $_SESSION['flash'];
            $_SESSION['flash'] = '';
        }

        $this->loggedUser = LoginHandler::checkLogin();
        if ($this->loggedUser) {
            $this->redirect('/admin/home');
        }

        $this->render('/admin/login', ['flash' => $flash]);
    }

    public function login()
    {
        $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
        $password = filter_input(INPUT_POST, 'password');

        if ($email && $password) {
            $token = LoginHandler::verifyLogin($email, $password);
            if ($token) {
                $_SESSION['auth'] = $token;
                $this->redirect('/admin/home');
            } else {
                $_SESSION['flash'] = [
                    'type' => 'error',
                    'message' => 'Email ou senha incorreto',
                ];
                $this->redirect('/admin');
            }
        }

        $_SESSION['flash'] = [
            'type' => 'error',
            'message' => 'Email ou senha não podem estar em branco',
        ];
        $this->redirect('/admin');

    }

    public function logout()
    {
        if (isset($_SESSION['auth'])) {
            unset($_SESSION['auth']);
        }

        $this->redirect('/admin');
    }
}
