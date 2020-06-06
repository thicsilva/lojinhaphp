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
        $viewsFolder = dirname(__DIR__, 1) . "/src/view";
        if (file_exists($viewsFolder . "/" . $folder . "/" . $viewName . ".php")) {

            extract($viewData);
            $render = fn($vN, $vD = []) => $this->renderPartial($vN, $vD);
            $base = $this->getBaseUrl();
            require $viewsFolder . "/" . $folder . "/" . $viewName . ".php";
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
