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

        if (isset($searchTerm) && !empty($searchTerm)) {
            $products = Product::all("name like '%$searchTerm%'", $this->limitPerPage, $offset);
        } else {
            $products = Product::all('', $this->limitPerPage, $offset);
        }
        $total = count($products);
        $pages = ceil($total / $this->limitPerPage);

        $searchTerm = filter_input(INPUT_GET, 'q');

        $this->render('site/home', ['products' => $products, 'pages' => $pages]);
    }
}
