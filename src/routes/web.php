<?php

use Core\Router;

$router = new Router();

/** Rotas do Site */
$router->get('/', 'Site\HomeController@index');
$router->get('/product/{id}', 'Site\HomeController@view');
$router->post('/cart/add', 'Site\CartController@add');
$router->post('/cart/update', 'Site\CartController@update');
$router->post('/cart/remove', 'Site\CartController@remove');
$router->post('/cart/reset', 'Site\CartController@reset');
$router->get('/cart', 'Site\CartController@index');
$router->post('/wish/add', 'Site\WishController@add');
$router->post('/wish/remove', 'Site\WishController@remove');
$router->get('/wish', 'Site\WishController@index');
$router->post('/checkout', 'Site\OrderController@createOrder');

/** Rotas do Painel */
$router->get('/admin', 'Admin\LoginController@index');
$router->post('/admin/login', 'Admin\LoginController@login');
$router->post('/admin/logout', 'Admin\LoginController@logout');

$router->get('/admin/home', 'Admin\PanelController@index');

$router->get('/admin/product', 'Admin\ProductController@index');
$router->get('/admin/product/create', 'Admin\ProductController@create');
$router->post('/admin/product/store', 'Admin\ProductController@store');
$router->get('/admin/product/edit/{id}', 'Admin\ProductController@edit');
$router->post('/admin/product/edit/{id}', 'Admin\ProductController@update');
$router->post('/admin/product/delete/{id}', 'Admin\ProductController@delete');

$router->get('/admin/user', 'Admin\UserController@index');
$router->get('/admin/user/create', 'Admin\UserController@create');
$router->post('/admin/user/store', 'Admin\UserController@store');
$router->get('/admin/user/edit/{id}', 'Admin\UserController@edit');
$router->post('/admin/user/edit/{id}', 'Admin\UserController@update');
$router->post('/admin/user/delete/{id}', 'Admin\UserController@delete');

$router->get('/admin/order', 'Admin\OrderController@index');
$router->get('/admin/order/view/{id}', 'Admin\OrderController@view');
