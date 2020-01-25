<?php namespace classes;

class Register
{
    private $username;
    private $hashedPassword;
    private $email;

    public function __construct($username, $password, $email)
    {
        $this->username = filter_var($username, FILTER_SANITIZE_STRING);
        $this->email = filter_var($email, FILTER_SANITIZE_EMAIL);
        $password = filter_var($password, FILTER_SANITIZE_STRING);

        if (empty($password)) {
            $this->hashedPassword = null;
        } else {
            $this->hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        }
    }

    public function validate()
    {
        // validate email
        if (isset($this->email) == false ||
            filter_var($this->email, FILTER_VALIDATE_EMAIL) == false ||
            strlen($this->email) > 65
        ) {
            return false;
        }

        // validate username
        if (isset($this->username) == false ||
            strlen($this->username) > 20 ||
            empty($this->username)
        ) {
            return false;
        }

        // validate password
        if (isset($this->hashedPassword) == false ||
            is_null($this->hashedPassword)
        ) {
            return false;
        }

        // all is validated
        return true;
    }

    private function checkDuplicate($pdo)
    {
        $sql = "SELECT UserName, UserEmail
                FROM users
                WHERE UserName = :UserName
                OR UserEmail = :UserEmail";

        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':UserName', $this->username);
        $stmt->bindParam(':UserEmail', $this->email);
        $stmt->execute();

        if ($stmt->fetch() !== false) {
            return false;
        } else {
            return true;
        }
    }

    public function addUser($pdo)
    {
        $accepted = $this->checkDuplicate($pdo);

        if (!$accepted) {
            return false;
        }

        $sql = "INSERT INTO users (UserName, UserPassword, UserEmail)
                VALUES (:UserName, :UserPassword, :UserEmail)";

        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':UserName', $this->username);
        $stmt->bindParam(':UserPassword', $this->hashedPassword);
        $stmt->bindParam(':UserEmail', $this->email);
        $stmt->execute();
        return true;
    }
}
