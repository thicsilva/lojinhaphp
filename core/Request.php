<?php

namespace Core;

class Request
{
    public static function getUrl()
    {
        $url = filter_input(INPUT_GET, "request");
        $url = str_replace(CONFIG['base_dir'], '', $url);
        return "/{$url}";
    }

    public static function getMethod()
    {
        return strtolower($_SERVER['REQUEST_METHOD']);
    }
}
