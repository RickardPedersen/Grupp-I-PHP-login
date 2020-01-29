<?php

namespace classes;

class LoggedInClass
{
    private $session;

    public function __construct($username = null, $email = null)
    {
        if (!(isset($username)) || !(isset($email))) {
            $_SESSION['user'] =
            array("error" => "Something went wrong with setting the session");
            $this->session = $_SESSION['user'];
        } else {
            $_SESSION['user'] = array("username" => $username, "email" => $email);
            $this->session = $_SESSION['user'];
        }
    }
    public function sendSessionData()
    {
        if (array_key_exists("error", $this->session)) {
            return $this->session["error"];
        } else {
            return implode(", ", $this->session);
        }
    }
    public function logout()
    {
        session_start();
        $_SESSION = array();
        return $_SESSION;
    }
}
