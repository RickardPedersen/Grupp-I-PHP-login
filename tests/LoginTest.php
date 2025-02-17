<?php

namespace tests;

require __DIR__ . '/../vendor/autoload.php';

use classes\Login;
use PHPUnit\Framework\TestCase;

class LoginUnitTesting extends TestCase
{
    public function testLoginIsObject()
    {
        //Assert that login __construct returns an object.
        $this->assertIsObject(new Login("TestUser", "123"));
    }
    public function testUsernameIsString()
    {
        //Checks if the FILTER_SANITIZE_STRING converts
        //non-string values To string.
        $username = 123;
        $filteredNumber = filter_var($username, FILTER_SANITIZE_STRING);
        $this->assertIsString($filteredNumber);
        $username = null;
        $filteredNull = filter_var($username, FILTER_SANITIZE_STRING);
        $this->assertIsString($filteredNull);
    }
}
