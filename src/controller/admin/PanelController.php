<?php

namespace App\Controller\Admin;

use App\Handler\LoginHandler;
use App\Model\Order;
use App\Model\Product;
use Core\Controller;

class PanelController extends Controller
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
        $totalProducts = Product::count();
        $firstDay = date('Y-m-01 00:00:00');
        $lastDay = date('Y-m-t 23:59:59');
        $totalOrders = Order::count("created_at>='$firstDay' and created_at<='$lastDay'");
        $monthSales = Order::totalOnPeriod($firstDay, $lastDay);

        $this->render('/admin/home', [
            'totalOrders' => $totalOrders,
            'totalProducts' => $totalProducts,
            'monthSales' => $monthSales,
            'authUser' => $this->authUser,
        ]);
    }
}
