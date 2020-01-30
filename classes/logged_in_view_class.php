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
        //Checks if the 'username' or 'email' session isn't set
        //and sets the $_SESSION to an array with a error.
        if (!(isset($_SESSION['username'])) || !(isset($_SESSION['email']))) {
            $_SESSION =
            array("error" => $this->errorMsg);
            $this->session = $_SESSION;
        //Else if 'username' or 'email' session is set, make $_SESSION to an
        //array with keys 'username' & 'email' and sets them to the classes sesison.
        } elseif ((isset($_SESSION['username'])) && (isset($_SESSION['email']))) {
            $_SESSION =
            array("username" => $_SESSION['username'], "email" => $_SESSION['email']);
            $this->session = $_SESSION;
        // If all else fails, set $_SESSION to an array with key 'error'
        //and set the classes session to $_SESSION.
        } else {
            $_SESSION =
            array("error" => $this->errorMsg);
            $this->session = $_SESSION;
        }
    }
    //Gets the Session's data.
    public function sendSessionData()
    {
        return $this->session;
    }
    //Set the $_SESSION to an empty array
    //(Just to be sure that nothing survives) and destroy the session.
    public function logout()
    {
        session_start();
        $_SESSION = array();
        session_destroy();
    }
}
