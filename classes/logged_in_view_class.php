<?php

namespace classes;

class LoggedInClass
{
    private $session;

    public function __construct($username = null, $email = null)
    {
        if (!(isset($username)) && !(isset($email))) {
            $_SESSION['user'] =
            array("usernameError" => "Failed setting username", "emailError" => "Failed setting email");
            $this->session = $_SESSION['user'];
        } elseif (!(isset($username))) {
            $_SESSION['user'] =
            array("usernameError" => "Failed setting username", "email" => "Email: $email");
            $this->session = $_SESSION['user'];
        } elseif (!(isset($email))) {
            $_SESSION['user'] =
            array("username" => "Username: $username", "emailError" => "Failed setting email");
            $this->session = $_SESSION['user'];
        } else {
            $_SESSION['user'] = array("username" => "Username: $username", "email" => "Email: $email");
            $this->session = $_SESSION['user'];
        }
    }
    public function sendSessionData()
    {
        return "<h2>" . implode("</h2><h2>", $this->session) . "</h2>";
    }
}
