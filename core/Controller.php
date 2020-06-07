<?php

namespace Core;

class Controller
{

    protected function redirect($url)
    {
        header("Location: " . $this->getBaseUrl() . $url);
        exit;
    }

    private function getBaseUrl()
    {
        $base = (isset($_SERVER['HTTPS']) && strtolower($_SERVER['HTTPS']) == 'on') ? 'https://' : 'http://';
        $base .= $_SERVER['SERVER_NAME'];
        if ($_SERVER['SERVER_PORT'] != 80) {
            $base .= ":" . $_SERVER['SERVER_PORT'];
        }
        $base .= CONFIG['base_dir'];

        return $base;
    }

    private function _render($folder, $viewName, $viewData = [])
    {
        if (file_exists('../src/view/' . $folder . '/' . $viewName . '.php')) {

            extract($viewData);

            $render = function($vN, $vD = []){
                var_dump($vN);
                var_dump($vD);
                return $this->renderPartial($vN, $vD);
            };
            $base = $this->getBaseUrl();
            require '../src/view/' . $folder . '/' . $viewName . '.php';
        }
    }

    private function renderPartial($viewName, $viewData = [])
    {
        $this->_render('partials', $viewData, $viewData);
    }

    public function render($viewName, $viewData = [])
    {
        $this->_render('pages', $viewName, $viewData);
    }
}
