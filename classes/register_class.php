<?php namespace classes;

class Register
{
    private $username;
    private $hashedPassword;
    private $email;
    private $validated;

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

        $this->validated = false;
    }

    public function validate()
    {
        $validatedInputs = array(
            'emailExists' => 'Please enter an email',
            'emailValid' => 'Please enter a valid email',
            'emailLength' => 'Email cannot be longer than 65 characters',
            'usernameExists' => 'Please enter a username',
            'usernameLength' => 'Username cannot be longer than 25 characters',
            'passwordExists' => 'Please enter a password',
            'allValid' => false
        );

        // validate email
        if (!empty($this->email)) {
            $validatedInputs['emailExists'] = '';
        }

        if (filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            $validatedInputs['emailValid'] = '';
        }

        if (strlen($this->email) <= 65) {
            $validatedInputs['emailLength'] = '';
        }

        // validate username
        if (!empty($this->username)) {
            $validatedInputs['usernameExists'] = '';
        }

        if (strlen($this->username) <= 20) {
            $validatedInputs['usernameLength'] = '';
        }

        // validate password
        if (!empty($this->hashedPassword)) {
            $validatedInputs['passwordExists'] = '';
        }

        // check if all is valid
        foreach ($validatedInputs as $key => $value) {
            if ($key == 'allValid') {
                $validatedInputs['allValid'] = true;
                $this->validated = true;
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
        // if (!$this->validated) {
        //     return false;
        // }

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
