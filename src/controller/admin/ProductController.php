<?php

namespace App\Controller\Admin;

use App\Handler\ImageHandler;
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

    public function create()
    {
        $this->render('/admin/products/create', [
            'authUser' => $this->authUser,
        ]);
    }

    public function store()
    {

        $allowedImage = [
            'image/jpeg',
            'image/jpg',
            'image/png',
        ];

        $name = filter_input(INPUT_POST, 'name');
        $description = filter_input(INPUT_POST, 'description');
        $price = filter_input(INPUT_POST, 'price', FILTER_VALIDATE_FLOAT);

        if (!$name || !$description || !$price) {
            $_SESSION['flash'] = [
                'type' => 'error',
                'message' => 'Todos os campos precisam ser preenchidos',
            ];

            $this->redirect('/admin/product/create');

        }
        $image = (!empty($_FILES['image'])) ? $_FILES['image'] : '';

        $img = false;

        $tmp_name = $image['tmp_name'];
        $type = $image['type'];

        if (in_array($type, $allowedImage)) {
            $img = ImageHandler::createImage($tmp_name, $type);
        }

        $product = new Product();
        $product->name = $name;
        $product->description = $description;
        $product->price = $price;
        $product->image = ($img) ? $img : 'noimage.png';
        $product->save();

        $this->redirect('/admin/product');
    }

}
