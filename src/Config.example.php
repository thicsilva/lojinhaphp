<?php

define("CONFIG", [
    "base_dir" => dirname(__DIR__, 1) . "/public",
]);

define("DATABASE", [
    "db_driver" => "mysql",
    "db_host" => "127.0.0.1",
    "db_port" => 3306,
    "db_name" => "dbname",
    "db_user" => "dbuser",
    "db_password" => "dbpass",
]);

define("ROUTER", [
    "error_controller" => "ErrorController",
    "default_action" => "index",
]);
