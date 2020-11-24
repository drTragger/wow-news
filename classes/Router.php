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
        } elseif (isset($_GET['edit_id'])){
            $action = 'edit';
        } elseif (isset($_SESSION['id'])){
            $action = 'newsItem';
        } elseif ($_GET['action'] === 'logout') {
            $action = 'logout';
        } elseif (isset($_POST['delete'])) {
            $action = 'delete';
        } elseif (isset($_POST['title'])) {
            $action = 'addNewsItem';
        } elseif ($_GET['action'] === 'edit') {
            $action = 'edit';
        }

        $controller->$action();
    }
}