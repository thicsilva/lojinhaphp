<?php

namespace App\Controller\Admin;

use App\Handler\LoginHandler;
use App\Model\Product;
use Core\Controller;

class ProductController extends Controller
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
        $products = Product::all();
        $this->render('/admin/products/index', [
            'products' => $products,
            'authUser' => $this->authUser,
        ]);
    }
}
