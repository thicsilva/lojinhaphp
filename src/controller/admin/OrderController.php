<?php

namespace App\Controller\Admin;

use App\Handler\LoginHandler;
use App\Model\Order;
use App\Model\Product;
use Core\Controller;

class OrderController extends Controller
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
        $orders = Order::all();
        $this->render('/admin/orders/index', [
            'orders' => $orders,
            'authUser' => $this->authUser,
        ]);
    }
}
