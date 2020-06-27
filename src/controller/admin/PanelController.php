<?php

namespace App\Controller\Admin;

use App\Handler\LoginHandler;
use App\Model\Order;
use App\Model\Product;
use Core\Controller;

class PanelController extends Controller
{
    private $loggedUser;

    public function __construct()
    {
        $this->loggedUser = LoginHandler::checkLogin();
        if ($this->loggedUser === false) {
            $this->redirect('/admin');
        }
    }
    public function index()
    {
        $totalProducts = Product::count();
        $totalOrders = Order::count();
        $firstDay = date('y-m-01 00:00:00');
        $lastDay = date('y-m-t 23:59:59');
        $monthSalesCount = count(Order::all("created_at>=$firstDay and created_at<=$lastDay"));

        $this->render('/admin/home');
    }
}
