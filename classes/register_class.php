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
        $validatedInputs = array(
            'emailExists' => false,
            'emailValid' => false,
            'emailLength' => false,
            'usernameExists' => false,
            'usernameLength' => false,
            'passwordExists' => false,
            'allValid' => false
        );

        // validate email
        if (!empty($this->email)) {
            $validatedInputs['emailExists'] = true;
        }

        if (filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            $validatedInputs['emailValid'] = true;
        }

        if (strlen($this->email) <= 65) {
            $validatedInputs['emailLength'] = true;
        }

        // validate username
        if (!empty($this->username)) {
            $validatedInputs['usernameExists'] = true;
        }

        if (strlen($this->username) <= 20) {
            $validatedInputs['usernameLength'] = true;
        }

        // validate password
        if (!empty($this->hashedPassword)) {
            $validatedInputs['passwordExists'] = true;
        }

        // check if all is valid
        foreach ($validatedInputs as $key => $value) {
            if ($key == 'allValid') {
                $validatedInputs['allValid'] = true;
            } elseif (!$value) {
                break;
            }
        }

        return $validatedInputs;
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
