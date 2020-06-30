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

    public function create()
    {
        $this->render('/admin/products/create', [
            'authUser' => $this->authUser,
        ]);
    }

    public function store()
    {
        $id = 123;

        $allowedImage = [
            'image/jpeg',
            'image/jpg',
            'image/png',
        ];

        $image = (!empty($_FILES['image'])) ? $_FILES['image'] : [];

        for ($q = 0; $q < count($image['name']); $q++) {
            $tmp_name = $image['tmp_name'][$q];
            $type = $image['type'][$q];

            if (in_array($type, $allowedImage)) {
                ImageHandler::createImage($id, $tmp_name, $type);
            }
        }
    }

   
    }
}
