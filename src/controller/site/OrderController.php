<?php

namespace App\Controller\Site;

use App\Model\Order;
use App\Model\OrderProduct;
use Core\Controller;

class OrderController extends Controller
{
    public function createOrder()
    {
        unset($_SESSION['old']);
        if (!isset($_SESSION['cart'])) {
            $_SESSION['flash'] = ['type' => 'error', 'message' => 'Não há itens no carrinho para finalizar as compras'];
            $this->redirect('/');
        }

        $name = filter_input(INPUT_POST, 'name');
        $address = filter_input(INPUT_POST, 'address');
        $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);

        if (!$name || !$address || !$email) {
            $_SESSION['flash'] = [
                'type' => 'error',
                'message' => 'Dados inválidos',
            ];

            $this->redirect('/cart');
        }

        $order = new Order();
        $order->name = $name;
        $order->address = $address;
        $order->email = $email;

        $order = $order->save();

        $cartItems = $_SESSION['cart'];
        $total = 0;

        foreach ($cartItems as $item) {
            $orderProduct = new OrderProduct();
            $orderProduct->order_id = $order->id;
            $orderProduct->product_id = $item['id'];
            $orderProduct->unit_price = (double) $item['price'];
            $orderProduct->quantity = (int) $item['quantity'];
            $orderProduct->total_price = $orderProduct->unit_price * $orderProduct->quantity;
            $orderProduct->save();
            $total += $orderProduct->total_price;
        }
        $order->total = $total;
        $order->save();
        unset($_SESSION['cart']);

        $this->render('site/success', ['order' => $order]);
    }
}
