<?php

use Core\Router;

$router = new Router();

$router->get('/', 'HomeController@index');
$router->post('/cart/add', 'CartController@add');
$router->post('/cart/update', 'CartController@update');
$router->post('/cart/remove', 'CartController@remove');
$router->post('/cart/reset', 'CartController@reset');
$router->get('/cart', 'CartController@index');
$router->post('/wish/add', 'WishController@add');
$router->post('/wish/remove', 'WishController@remove');
$router->get('/wish', 'WishController@index');
