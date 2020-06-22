<?php

use Core\Router;

$router = new Router();

/** Rotas do Site */
$router->get('/', 'HomeController@index');
$router->post('/cart/add', 'CartController@add');
$router->post('/cart/update', 'CartController@update');
$router->post('/cart/remove', 'CartController@remove');
$router->post('/cart/reset', 'CartController@reset');
$router->get('/cart', 'CartController@index');
$router->post('/wish/add', 'WishController@add');
$router->post('/wish/remove', 'WishController@remove');
$router->get('/wish', 'WishController@index');

/** Rotas do Painel */
$router->get('/admin', 'LoginController@index');
$router->post('/admin/login', 'LoginController@login');
$router->post('/admin/logout', 'LoginController@logout');

$router->get('/admin/home', 'PanelController@index');

$router->get('/admin/product', 'ProductController@index');
$router->get('/admin/product/create', 'ProductController@create');
$router->post('/admin/product/store', 'ProductController@store');
$router->get('/admin/product/edit/{id}', 'ProductController@edit');
$router->post('/admin/product/edit/{id}', 'ProductController@update');
$router->post('/admin/product/delete/{id}', 'ProductController@delete');

$router->get('/admin/user', 'UserController@index');
$router->get('/admin/user/create', 'UserController@create');
$router->post('/admin/user/store', 'UserController@store');
$router->get('/admin/user/edit/{id}', 'UserController@edit');
$router->post('/admin/user/edit/{id}', 'UserController@update');
$router->post('/admin/user/delete/{id}', 'UserController@delete');
