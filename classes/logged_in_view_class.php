<?php

namespace classes;

class LoggedInClass
{
    private $session;
    private $username;
    private $email;
    private $errorMsg = "Something went wrong with setting the session.";

    public function __construct()
    {
        if (!(isset($_SESSION['username'])) || !(isset($_SESSION['email']))) {
            $_SESSION =
            array("error" => $errorMsg);
            $this->session = $_SESSION;
        } elseif ((isset($_SESSION['username'])) && (isset($_SESSION['email']))) {
            $_SESSION =
            array("username" => $_SESSION['username'], "email" => $_SESSION['email']);
            $this->session = $_SESSION;
        } else {
            $_SESSION =
            array("error" => $errorMsg);
            $this->session = $_SESSION;
        }
    }
    public function sendSessionData()
    {
        if (array_key_exists("error", $this->session)) {
            return $this->session["error"];
        } else {
            return $this->session;
        }
    }
    public function logout()
    {
        session_start();
        $_SESSION = array();
        return $_SESSION;
    }
}
