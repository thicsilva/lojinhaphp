<?php

namespace App\Controller;

use App\Model\Product;
use Core\Controller;

class HomeController extends Controller
{
    public function index()
    {
        $products = Product::all('', 9);
        $this->render('site/home', ['products' => $products]);
    }

    public function search()
    {
        $searchTerm = filter_input(INPUT_POST, 'search');
        $products = Product::all("name like '%$searchTerm%'");
        return $this->render('site/home', ['products' => $products]);
    }
}
