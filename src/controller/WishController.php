<?php

namespace App\Controller;

use App\Model\Product;
use Core\Controller;

class WishController extends Controller
{
    private $limitPerPage = 9;

    public function index()
    {
        $searchTerm = filter_input(INPUT_GET, 'q');
        $page = filter_input(INPUT_GET, 'page', FILTER_VALIDATE_INT, [
            'options' => [
                'default' => 1,
                'min_range' => 1,
            ],
        ]);

        $offset = ($page - 1) * $this->limitPerPage;
        $total = 0;

        if (isset($_COOKIE['wish'])) {

            if (isset($searchTerm) && !empty($searchTerm)) {
                $products = Product::all("name like '%$searchTerm%' and id in (" . $_COOKIE['wish'] . ")", $this->limitPerPage, $offset);
                $total = count(Product::all("name like '%$searchTerm%' and id in (" . $_COOKIE['wish'] . ")"));
            } else {
                $products = Product::all("id in (" . $_COOKIE['wish'] . ")", $this->limitPerPage, $offset);
                $total = count(Product::all("id in (" . $_COOKIE['wish'] . ")"));
            }

        } else {
            $products = [];

        }

        $pages = ceil($total / $this->limitPerPage);

        $this->render('site/wishlist', [
            'products' => $products,
            'pages' => [
                "total" => $pages,
                "current" => $page,
                "searchTerm" => $searchTerm,
            ],
        ]);
    }

    public function add()
    {
        $param = filter_input(INPUT_POST, 'product');

        if (isset($_COOKIE['wish'])) {
            if (strpos($_COOKIE["wish"], $param) === false) {
                setcookie("wish", $_COOKIE["wish"] . "," . $param, time() + 60 * 60 * 24 * 30);
            }
        } else {
            setcookie("wish", $param, time() + 60 * 60 * 24 * 30);
        }
        $_SESSION['flash'] = [
            "type" => "success",
            "message" => "Produto adicionado aos favoritos",
        ];
        $this->redirect('/wish');
    }

    public function remove()
    {
        $param = filter_input(INPUT_POST, 'product');

        if (isset($_COOKIE['wish'])) {
            if (strpos($_COOKIE["wish"], $param) !== false) {
                $wish = $_COOKIE["wish"];
                $wish = str_replace("," . $param . ",", ",", $wish);
                $wish = str_replace($param . ",", "", $wish);
                $wish = str_replace("," . $param, "", $wish);
                $wish = str_replace($param, "", $wish);
                setcookie("wish", $wish, time() + 60 * 60 * 24 * 30);

            }
        }
        $this->redirect('/wish');
    }
}
