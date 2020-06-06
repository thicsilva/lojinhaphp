<?php

namespace App\Controller;

use Core\Controller;

class ErrorController extends Controller
{
    public function index()
    {
        $this->render('404');
    }
}
