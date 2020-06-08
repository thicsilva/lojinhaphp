<?php

use Core\Router;

$router = new Router();

$router->get('/', 'HomeController@index');
$router->post('/', 'HomeController@search');
