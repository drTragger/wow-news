<?php


class Controller
{
    private $view;
    private $news;
    private $user;

    public function __construct()
    {
        $this->view = new View();
        $this->news = new News();
        $this->user = new User();
    }

    public function main()
    {
        $this->view->page = 'main';
        $this->view->render(NULL);
    }

    public function login()
    {
        $username = filter_input(INPUT_POST, 'username');
        $password = filter_input(INPUT_POST, 'password');
        $this->user->login($username, $password);
        Router::redirect();
    }

    public function logout()
    {
        unset($_SESSION['login']);
        Router::redirect();
    }
}