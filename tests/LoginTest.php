<?php

require __DIR__ . '/../vendor/autoload.php';

use PHPUnit\Framework\TestCase;

class LoginUnitTesting extends TestCase
{
    private $usernameOrEmail = "TestUser";
    private $password = "123";

    public function testLoginIsObject()
    {
        //Assert that login __construct returns an object.
        $this->assertIsObject(new classes\Login($this->usernameOrEmail, $this->password));
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
