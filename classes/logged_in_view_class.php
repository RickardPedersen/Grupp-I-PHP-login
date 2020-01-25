<?php

/*
* laddar in alla våra klasser
require __DIR__ . '/../vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR);
* gör så vi kan använda .env variabler med getenv('variabelnamn')
$dotenv->load();
* skapar databasobjekt
$db = new classes\MySQL();
* skapar pdo connection
$pdo = $db->connect();
*/
namespace classes;

class LoggedInClass
{
    private $session;

    public function __construct($session = null)
    {
        if (!(isset($session))) {
            $session = $_SESSION['user'];
            $_SESSION['user'] =
            "Something went wrong with setting the session";
            $this->session = $session;
        } else {
            $_SESSION['user'] = $session;
            $this->session = $session;
        }
    }
    public function printSession()
    {
        return $this->session;
    }
}
