<?php

namespace App\Controller\Admin;

use App\Model\Product;
use Core\Controller;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        $this->render('/admin/products/index');
    }
}