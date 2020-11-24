<?php


class News
{
    private $news;
    private $db;

    public function __construct()
    {
        $this->db = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
    }

    public function getAllNews()
    {
        $query = "SELECT news.id, news.title, news.description, news.created_at, users.user_name FROM news INNER JOIN users ON news.author_id = users.id;";
        $result = $this->db->query($query);
        if ($result) {
            while ($tmp = $result->fetch_assoc()) {
                $this->news[] = $tmp;
            }
        }
        return $this->news;
    }

    /**
     * @param string $title
     * @param string $description
     * @return string
     */
    public function edit($title, $description, $editionId = NULL)
    {
        $title = trim($title);
        $description = trim($description);

        if (empty($title)) {
            $_SESSION['message'] = 'Title should not be empty';
            $_SESSION['description'] = $description;
            Router::redirect();
        } elseif (empty($description)) {
            $_SESSION['message'] = 'Description should not be empty';
            $_SESSION['title'] = $title;
            Router::redirect();
        }

        $query = "SELECT id FROM users WHERE user_name LIKE '{$_SESSION['login']}';";
        $result = $this->db->query($query);
        $userId = (int)$result->fetch_row();
        if (!$userId) {
            $_SESSION['message'] = 'Failed to get user id. Please, re-login and try again.';
            Router::redirect();
        }

        $date = new DateTime();
        $freshDate = $date->format('Y-m-d H:i:s');

        if ($editionId) {
            $query = "UPDATE news SET title = '$title', description = '$description' WHERE id = '$editionId';";
        } else {
            $query = "INSERT INTO news (id, title, description, author_id, created_at) VALUES (NULL, '$title', '$description', '$userId', '$freshDate');";
        }
        return $this->db->query($query);
    }

    public function getLatestNewsId()
    {
        $query = "SELECT id FROM news WHERE id = (SELECT MAX(id) FROM news);";
        $result = $this->db->query($query);
        return (int)$result->fetch_row()[0];
    }

    public function getNewsItem($id)
    {
        $query = "SELECT news.id, news.title, news.description, news.created_at, users.user_name FROM news INNER JOIN users ON news.author_id = users.id WHERE news.id = '$id';";
        $result = $this->db->query($query);
        if ($result) {
            while ($tmp = $result->fetch_assoc()) {
                $this->news[] = $tmp;
            }
        }
        return $this->news;
    }

    public function delete($id)
    {
        $query = "DELETE FROM news WHERE id = '$id';";
        $this->db->query($query);
    }
}