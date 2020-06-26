<?php

namespace App\Controller\Admin;

use App\Model\Product;
use App\Model\Order;
use App\Traits\LoginTrait;
use Core\Controller;

class PanelController extends Controller
{
    use LoginTrait;
    public function index(){
        if (!$this->hasAuth()){
            $this->redirect('/admin');
        }

        $totalProducts = Product::count();
        $totalOrders = Order::count();
        $firstDay = date('y-m-01 00:00:00');
        $lastDay = date('y-m-t 23:59:59');
        $monthSalesCount = count(Order::all("created_at>=$firstDay and created_at<=$lastDay"));

        $this->render('/admin/home');
    }
}