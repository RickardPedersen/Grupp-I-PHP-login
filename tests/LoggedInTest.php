<?php
require __DIR__ . '/../vendor/autoload.php';

use classes\LoggedInClass;
use PHPUnit\Framework\TestCase;

class LoggedInUnitTesting extends TestCase
{
    protected $LoggedIn;

    public function testSession()
    {
        $username = 'test';
        $email = 'test@test.se';
        $this->LoggedIn = new LoggedInClass($username, $email);
        echo $this->LoggedIn->sendSessionData();
        $this->assertEquals('test, test@test.se', $this->LoggedIn->sendSessionData());
    }
}
