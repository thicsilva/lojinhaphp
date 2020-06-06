<?php

use Core\Router;

$router = new Router();

$router->get('/', 'HomeController@index');
$router->post('/view/{product}', 'ProductController@view');
