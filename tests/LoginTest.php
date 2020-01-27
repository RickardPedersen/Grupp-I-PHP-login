<?php

require __DIR__ . '/../vendor/autoload.php';

use classes\LoggedInClass;
use PHPUnit\Framework\TestCase;

class LoginUnitTesting extends TestCase
{

    public function testLoginIsObject()
    {
        //Assert that login __construct returns an object.
        $usernameOrEmail = "TestUser";
        $password = "123";
        $this->assertIsObject(new classes\Login($usernameOrEmail, $password));
    }
    public function testUsernameIsString()
    {
        $username = 123;
        $filteredNumber = filter_var($username, FILTER_SANITIZE_STRING);
        $this->assertIsString($filteredNumber);
        $username = null;
        $filteredNull = filter_var($username, FILTER_SANITIZE_STRING);
        $this->assertIsString($filteredNull);
    }
}
