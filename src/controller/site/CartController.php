<?php

namespace App\Controller\Site;

use App\Model\Product;
use Core\Controller;

class CartController extends Controller
{
    public function index()
    {
        $cartItems = [];
        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }
        $cartItems = $_SESSION['cart'];

        $this->render('/site/cart', ['cartItems' => $cartItems]);
    }

    public function add()
    {
        $param = filter_input(INPUT_POST, 'product');
        $product = Product::find($param);
        $productCart = [
            $param => [
                'id' => $product->id,
                'name' => $product->name,
                'price' => $product->price,
                'image' => $product->image,
                'quantity' => empty(filter_input(INPUT_POST, 'quantity')) ? 1 : filter_input(INPUT_POST, 'quantity'),
            ],
        ];
        if (!empty($_SESSION['cart'])) {
            if (in_array($param, array_keys($_SESSION['cart']))) {
                foreach ($_SESSION['cart'] as $key => $item) {
                    if ($param == $key) {
                        if (empty($_SESSION['cart'][$key]['quantity'])) {
                            $_SESSION['cart'][$key]['quantity'] = 0;
                        }
                        $_SESSION['cart'][$key]['quantity'] += empty(filter_input(INPUT_POST, 'quantity')) ? 1 : filter_input(INPUT_POST, 'quantity');
                    }
                }
            } else {
                $_SESSION['cart'] = $_SESSION['cart'] + $productCart;
            }
        } else {
            $_SESSION['cart'] = $productCart;
        }
        $_SESSION['flash'] = [
            "type" => "success",
            "message" => "Produto adicionado ao carrinho",
        ];
        $this->redirect('/cart');
    }

    public function update()
    {
        $param = filter_input(INPUT_POST, 'product');
        $quantity = filter_input(INPUT_POST, 'quantity');
        if (!empty($_SESSION['cart'])) {
            if (in_array($param, array_keys($_SESSION['cart']))) {
                foreach ($_SESSION['cart'] as $key => $item) {
                    if ($param == $key) {
                        if ($quantity <= 0) {
                            unset($_SESSION['cart'][$key]);
                        } else {
                            $_SESSION['cart'][$key]['quantity'] = $quantity;
                        }
                    }
                }
            }
        }
        $_SESSION['flash'] = ["type" => "success", "message" => "Carrinho atualizado"];
        $this->redirect('/cart');
    }

    public function remove()
    {
        $param = filter_input(INPUT_POST, 'product');
        if (!empty($_SESSION['cart'])) {
            foreach ($_SESSION['cart'] as $key => $item) {
                if ($param == $key) {
                    unset($_SESSION['cart'][$param]);
                }
                if (empty($_SESSION['cart'])) {
                    unset($_SESSION['cart']);
                }
            }
        }
        $this->redirect('/cart');
    }

    public function reset()
    {
        unset($_SESSION['cart']);
        $this->redirect('/cart');
    }
}
