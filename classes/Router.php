<?php


class Router
{
    static public function redirect()
    {
        header('Location: ' . $_SERVER['PHP_SELF']);
    }

    static public function init()
    {
        session_start();
        $controller = new Controller();
        $action = 'main';
        if (isset($_POST['username'])) {
            $action = 'login';
        } elseif ($_GET['action'] === 'logout') {
            $action = 'logout';
        }

        $controller->$action();
    }
}