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
        $page = (isset($_GET['page'])) ? filter_input(INPUT_GET, 'page') : 1;
        View::$currentPage = $page;
        $this->view->render($this->news->getNews($page));
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

    public function edit()
    {
        $this->view->page = 'new_news';
        if (isset($_GET['edit_id'])) {
            $id = filter_input(INPUT_GET, 'edit_id');
            $this->view->render($this->news->getNewsItem($id)[0]);
            return true;
        }
        $this->view->render(NULL);
        return false;
    }

    public function addNewsItem()
    {
        $title = filter_input(INPUT_POST, 'title');
        $description = filter_input(INPUT_POST, 'description');
        $id = (isset($_POST['edition'])) ? $_POST['edition'] : NULL;
        if (mb_strlen($title) > 255) {
            $_SESSION['message'] = 'Title should not be longer than 255 symbols';
            Router::redirect();
        } elseif ($id) {
            $this->news->edit($title, $description, $id);
            Router::redirect();
        } elseif ($this->news->edit($title, $description)) {
            $_SESSION['message'] = 'News created successfully';
            $_SESSION['id'] = $this->news->getLatestNewsId();
            Router::redirect();
        } else {
            $_SESSION['message'] = 'Failed to add news. Please, try again';
            Router::redirect();
        }
    }

    public function newsItem()
    {
        $this->view->page = 'news_item';
        $id = (isset($_GET['id'])) ? filter_input(INPUT_GET, 'id') : $_SESSION['id'];
        $this->view->render($this->news->getNewsItem($id));
    }

    public function delete()
    {
        $id = filter_input(INPUT_POST, 'delete');
        if ($this->news->delete($id)) {
            $_SESSION['message'] = 'Deleted successfully';
        } else {
            $_SESSION['message'] = 'There was a problem deleting the news';
        }
        if (isset($_GET['page'])) {
            $page = filter_input(INPUT_GET, 'page');
            header('Location: ' . $_SERVER['PHP_SELF'] . '?page=' . $page);
        } else {
            Router::redirect();
        }
    }
}