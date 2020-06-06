<?php
ob_start();
session_start();

require dirname(__DIR__, 1) . '/vendor/autoload.php';
require dirname(__DIR__, 1) . '/src/routes/web.php';
require dirname(__DIR__, 1) . '/src/Config.php';

$router->run($router->routes);

ob_end_flush();
