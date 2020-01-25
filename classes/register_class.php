<?php namespace classes;

class Register
{
    private $username;
    private $password;
    private $email;
    private $acceptedStatus;

    public function __construct($username, $password, $email)
    {
        $this->username = $username;
        $this->password = $password;
        $this->email = $email;
        $this->acceptedStatus = false;
    }
}
