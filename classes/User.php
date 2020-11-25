<?php


class User
{
    private $db;
    private $users;

    public function __construct()
    {
        $this->db = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
    }

    /**
     * @param string $username
     * @param string $password
     * @return bool
     */
    public function login($username, $password)
    {
        $username = mb_strtolower(trim($username));
        $password = mb_strtolower(trim($password));
        if (empty($username)) {
            $_SESSION['message'] = 'Username should not be empty';
            Router::redirect();
        } elseif (empty($password)) {
            $_SESSION['message'] = 'Password should not be empty';
            Router::redirect();
        }

        $this->getAllUsers();

        $noUser = true;
        foreach ($this->users as $user) {
            if ($user['user_name'] === $username) {
                $noUser = false;
                $check = password_verify("$password", $user['password']);
                if ($check) {
                    $_SESSION['login'] = $username;
                    return true;
                } else {
                    $_SESSION['message'] = 'Wrong password';
                    $_SESSION['username'] = $username;
                    return false;
                }
            }
        }

        if ($noUser) {
            $pwdHash = password_hash($password, PASSWORD_DEFAULT);
            $query = "INSERT INTO users (id, user_name, password) VALUES (NULL, '$username', '$pwdHash');";
            if ($this->db->query($query)) {
                $_SESSION['login'] = $username;
                return true;
            }
        }
    }

    public function getAllUsers()
    {
        $query = "SELECT * FROM users;";
        $result = $this->db->query($query);
        if ($result) {
            while ($tmp = $result->fetch_assoc()) {
                $this->users[] = $tmp;
            }
        }
        return $this->users;
    }
}