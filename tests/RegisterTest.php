<?php namespace tests;

require __DIR__ . '/../vendor/autoload.php';

use classes\MySQL;
use classes\Register;
use PHPUnit\Framework\TestCase;

class RegisterUnitTesting extends TestCase
{
    public function testRegisterObject()
    {
        $user = new Register('TestUser', 'TestPassword1337', 'test@mail.com');

        $this->assertIsObject($user);
        $this->assertInstanceOf(Register::class, $user);
        $this->assertObjectHasAttribute('username', $user);
        $this->assertObjectHasAttribute('hashedPassword', $user);
        $this->assertObjectHasAttribute('email', $user);
        $this->assertObjectHasAttribute('validated', $user);
    }

    public function testValidateSuccess()
    {
        $user = new Register('TestUser', 'TestPassword1337', 'test@mail.com');
        $validateCheckArray = $user->validate();

        $this->assertIsArray($validateCheckArray);
        $this->assertArrayHasKey('emailExists', $validateCheckArray);
        $this->assertArrayHasKey('emailValid', $validateCheckArray);
        $this->assertArrayHasKey('emailLength', $validateCheckArray);
        $this->assertArrayHasKey('usernameExists', $validateCheckArray);
        $this->assertArrayHasKey('usernameLength', $validateCheckArray);
        $this->assertArrayHasKey('passwordExists', $validateCheckArray);
        $this->assertArrayHasKey('allValid', $validateCheckArray);
        $this->assertTrue($validateCheckArray['allValid']);
    }

    public function testValidateFailure()
    {
        $user = new Register('TestUsernameIsTooLong', '', 'testmail.com');
        $validateCheckArray = $user->validate();

        $this->assertIsArray($validateCheckArray);
        $this->assertArrayHasKey('emailExists', $validateCheckArray);
        $this->assertArrayHasKey('emailValid', $validateCheckArray);
        $this->assertArrayHasKey('emailLength', $validateCheckArray);
        $this->assertArrayHasKey('usernameExists', $validateCheckArray);
        $this->assertArrayHasKey('usernameLength', $validateCheckArray);
        $this->assertArrayHasKey('passwordExists', $validateCheckArray);
        $this->assertArrayHasKey('allValid', $validateCheckArray);
        $this->assertFalse($validateCheckArray['allValid']);
    }

    public function testAddUserFailure()
    {
        $dotenv = \Dotenv\Dotenv::createImmutable(__DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR);
        $dotenv->load();

        $db = new MySQL();
        $pdo = $db->connect();
        
        // username and email already exists in database
        $user = new Register('TestUser', 'TestPassword1337', 'test@mail.com');
        $validateCheckArray = $user->validate();
        $this->assertTrue($validateCheckArray['allValid']);
        $this->assertFalse($user->addUser($pdo));
    }

    public function testAddUserSuccess()
    {
        $dotenv = \Dotenv\Dotenv::createImmutable(__DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR);
        $dotenv->load();

        $db = new MySQL();
        $pdo = $db->connect();

        // username and email should be available
        $user = new Register('mJIu7k39OVmzfiMOBnsW', 'TestPassword1337', 'ehCQfdN3sZca0CfW4uRx@Vr1k9EYuSFiQahgdZ7.com');
        $validateCheckArray = $user->validate();
        $this->assertTrue($validateCheckArray['allValid']);
        $this->assertTrue($user->addUser($pdo));
    }

    // removes test user "mJIu7k39OVmzfiMOBnsW" after all tests are done
    public static function tearDownAfterClass(): void
    {
        $dotenv = \Dotenv\Dotenv::createImmutable(__DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR);
        $dotenv->load();

        $db = new MySQL();
        $pdo = $db->connect();

        $sql = 'DELETE FROM users WHERE UserName = "mJIu7k39OVmzfiMOBnsW"';
        $pdo->exec($sql);
    }
}
