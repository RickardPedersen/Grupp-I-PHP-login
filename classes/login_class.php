<?php namespace classes;

class Login
{
    private $usernameOrEmail;
    private $password;

    public function __construct($usernameOrEmail, $password)
    {
        $this->usernameOrEmail = filter_var($usernameOrEmail, FILTER_SANITIZE_STRING);
        $this->password = filter_var($password, FILTER_SANITIZE_STRING);
    }

    public function login($pdo)
    {
        $inputChecks = array(
            'usernameOrEmailMatch' => false,
            'passwordMatch' => false
        );

        $sql = "SELECT UserName, UserEmail, UserPassword
                FROM users
                WHERE UserName = :UserName
                OR UserEmail = :UserEmail";

        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':UserName', $this->usernameOrEmail);
        $stmt->bindParam(':UserEmail', $this->usernameOrEmail);
        $stmt->execute();

        $result = $stmt->fetch();

        // check if username or email exists
        if ($result) {
            // username or email OK
            $inputChecks['usernameOrEmailMatch'] = true;

            // check if password is correct
            if (password_verify($this->password, $result['UserPassword'])) {
                // correct password

                // start session
                session_start();
                $_SESSION['username'] = $result['UserName'];
                $_SESSION['email'] = $result['UserEmail'];

                $inputChecks['passwordMatch'] = true;
                return $inputChecks;
            } else {
                // wrong password
                return $inputChecks;
            }
        } else {
            // username or email not found
            return $inputChecks;
        }
    }
}
