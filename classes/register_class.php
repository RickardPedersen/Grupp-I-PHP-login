<?php

namespace classes;

/**
 * Register class requires 3 parameters (username, password, email)
 * validate method must be run before addUser method
 */
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

        /**
         * If password input is empty, the password will not be hashed
         * This will fail the validate checks
         */
        if (empty($password)) {
            $this->hashedPassword = null;
        } else {
            $this->hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        }

        $this->validated = false;
    }

    /**
     * Check inputs for specific requirements
     * Returns an array
     * 'allValid' become true if all requirements are met
     */
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

        // check if there is an email input
        if (!empty($this->email)) {
            $validatedInputs['emailExists'] = '';
        }

        // check if email input is a vaild email adress
        if (filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            $validatedInputs['emailValid'] = '';
        }

        // check if email input is 65 characters or less
        if (strlen($this->email) <= 65) {
            $validatedInputs['emailLength'] = '';
        }

        // check if the is a username input
        if (!empty($this->username)) {
            $validatedInputs['usernameExists'] = '';
        }

        // check if username input is 20 characters or less
        if (strlen($this->username) <= 20) {
            $validatedInputs['usernameLength'] = '';
        }

        // check if there is a password input
        if (!empty($this->hashedPassword)) {
            $validatedInputs['passwordExists'] = '';
        }

        // check if all is valid
        foreach ($validatedInputs as $key => $value) {
            if ($key == 'allValid') {
                $validatedInputs['allValid'] = true;
                $this->validated = true;
            } elseif (strlen($value) > 0) {
                break;
            }
        }

        return $validatedInputs;
    }

    /**
     * Method is called from the addUser method
     * Checks if username or email already exists in the database
     */
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

    /**
     * Tries to add user to the database
     * Will return false if user has not been validated
     * Will return false if a duplicate was found in the database
     * Will return true if user was successfully added to the database
     */
    public function addUser($pdo)
    {
        if (!$this->validated) {
            return false;
        }

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
