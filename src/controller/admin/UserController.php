<?php

namespace App\Controller\Admin;

use App\Handler\LoginHandler;
use App\Model\User;
use Core\Controller;

class UserController extends Controller
{
    private $authUser;

    public function __construct()
    {
        $this->authUser = LoginHandler::checkLogin();
        if ($this->authUser === false) {
            $this->redirect('/admin');
        }
    }

    public function index()
    {
        $users = User::all();
        $this->render('/admin/users/index', [
            'users' => $users,
            'authUser' => $this->authUser,
        ]);
    }

    public function create()
    {
        $this->render('/admin/users/create', [
            'authUser' => $this->authUser,
        ]);
    }

    public function store()
    {

        $name = filter_input(INPUT_POST, 'name');
        $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
        $password = filter_input(INPUT_POST, 'password');

        if (!$name || !$email || !$password) {
            $_SESSION['flash'] = [
                'type' => 'error',
                'message' => 'Todos os campos precisam ser preenchidos',
            ];

            $this->redirect('/admin/user/create');

        }

        $user = new User();
        $user->name = $name;
        $user->email = $email;
        $user->password = password_hash($password, PASSWORD_BCRYPT);
        $user->save();

        $_SESSION['flash'] = [
            'type' => 'success',
            'message' => 'Usuário incluído',
        ];

        $this->redirect('/admin/user');
    }

    public function edit($param)
    {
        $user = User::find($param['id']);
        $this->render('/admin/users/edit', [
            'authUser' => $this->authUser,
            'user' => $user,
        ]);
    }

    public function update($param)
    {
        $name = filter_input(INPUT_POST, 'name');
        $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
        $password = filter_input(INPUT_POST, 'password', FILTER_VALIDATE_FLOAT);

        if (!$name || !$email) {
            $_SESSION['flash'] = [
                'type' => 'error',
                'message' => 'Todos os campos precisam ser preenchidos',
            ];

            $this->redirect('/admin/user/create');

        }

        $user = User::find($param['id']);
        $user->name = $name;
        $user->email = $email;
        $user->password = (empty($password)) ? $user->password : password_hash($password, PASSWORD_BCRYPT);
        $user->save();

        $_SESSION['flash'] = [
            'type' => 'success',
            'message' => 'Usuário alterado',
        ];

        $this->redirect('/admin/user');
    }

    public function delete($param)
    {
        if (User::count() > 1) {

            $user = User::find($param['id']);
            $user->destroy();
            $_SESSION['flash'] = [
                'type' => 'success',
                'message' => 'Usuário excluído',
            ];

            $this->redirect('/admin/user');
        }

        $_SESSION['flash'] = [
            'type' => 'error',
            'message' => 'É necessário que tenha pelo menos 1 usuário no sistema',
        ];

        $this->redirect('/admin/user');
    }

}
