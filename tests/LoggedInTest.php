<?php

namespace tests;

require __DIR__ . '/../vendor/autoload.php';

use classes\LoggedInClass;
use classes\Login;
use classes\MySQL;
use PHPUnit\Framework\TestCase;

class LoggedInUnitTesting extends TestCase
{
    protected $LoggedIn;
    protected $Login;

    public function testSession()
    {
        $dotenv = \Dotenv\Dotenv::createImmutable(__DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR);
        $dotenv->load();
        $db = new MySQL();
        $pdo = $db->connect();

        $username = 'nejnej';
        $password = 'nejnej';

        $this->Login = new Login($username, $password);
        $this->Login->login($pdo);
        $this->LoggedIn = new LoggedInClass();
        $this->assertEquals(array('username'=>'nejnej', 'email'=>'nej@nej.se'), $this->LoggedIn->sendSessionData());
    }
}
