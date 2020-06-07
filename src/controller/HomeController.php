<?php

namespace App\Controller;

use App\Model\Customer;
use Core\Controller;
use DateTime;

class HomeController extends Controller
{
    public function index()
    {
        $customer = new Customer;
        $customer->name = "Thiago da Costa Silva";
        $customer->email = "thicsilva@yahoo.com.br";
        $customer->password = $customer->encryptPassword("1234");
        
        if ($customer->save()){
            $success = "Deu certo";
        } else {
            $success = "Deu erro";
        }
        $this->render('site/home', [$success]);
    }
}
