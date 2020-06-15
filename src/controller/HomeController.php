<?php

namespace App\Controller;

use App\Model\Product;
use Core\Controller;

class HomeController extends Controller
{
    private $limitPerPage = 9;

    public function index()
    {
        $page = filter_input(INPUT_GET, 'page', FILTER_VALIDATE_INT, [
            'options' => [
                'default' => 1,
                'min_range' => 1,
            ],
        ]);

        $offset = ($page - 1) * $this->limitPerPage;

        $searchTerm = filter_input(INPUT_GET, 'q');

        if (isset($searchTerm) && !empty($searchTerm)) {
            $products = Product::all("name like '%$searchTerm%'", $this->limitPerPage, $offset);
            $total =  count(Product::all("name like '%$searchTerm%'"));
        } else {
            $products = Product::all('', $this->limitPerPage, $offset);
            $total = count(Product::all());
        }

        $pages = ceil($total / $this->limitPerPage);
        // var_dump($pages, $total, $products);
        // exit;

        $this->render('site/home', ['products' => $products, 'pages' => [
            "total" => $pages,
            "current" => $page,
            "searchTerm" => $searchTerm]
        ]);
    }
}
