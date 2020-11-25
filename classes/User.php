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
     * logging in a user or creating a new one if doesn't exist
     * @param string $username
     * @param string $password
     * @return bool
     */
    public function login($username, $password)
    {
        $username = mb_strtolower(trim($username));
        $password = mb_strtolower(trim($password));

        $usernameLength = mb_strlen($username);
        $passwordLength = mb_strlen($password);

        // Validating the fields
        if (empty($username)) {
            $message = 'Username should not be empty';
        } elseif ($usernameLength < 5) {
            $message = "Username should not be shorter than 5 symbols";
        } elseif ($usernameLength > 60) {
            $message = 'Username should not be longer than 60 symbols';
        } elseif (empty($password)) {
            $message = 'Password should not be empty';
        } elseif ($passwordLength < 5) {
            $message = 'Password should not be shorter than 5 symbols';
        } elseif ($passwordLength > 60) {
            $message = 'Password should not be longer than 60 symbols';
        }

        if (isset($message)) {
            $_SESSION['message'] = $message;
            Router::redirect();
            exit();
        }

        $this->getAllUsers();

        // Logging in the user if exists
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

        // Creating a new user and logging in
        if ($noUser) {
            $pwdHash = password_hash($password, PASSWORD_DEFAULT);
            $query = "INSERT INTO users (id, user_name, password) VALUES (NULL, '$username', '$pwdHash');";
            if ($this->db->query($query)) {
                $_SESSION['login'] = $username;
                return true;
            }
        }
    }

    /**
     * Gets all the users
     * @return array
     */
    private function getAllUsers()
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