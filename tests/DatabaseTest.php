<?php namespace tests;

require __DIR__ . '/../vendor/autoload.php';

use classes\MySQL;
use PHPUnit\Framework\TestCase;

class DatabaseUnitTesting extends TestCase
{
    public function testDatabaseObject()
    {
        $dotenv = \Dotenv\Dotenv::createImmutable(__DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR);
        $dotenv->load();

        $db = new MySQL();

        $this->assertIsObject($db);
        $this->assertInstanceOf(MySQL::class, $db);
        $this->assertObjectHasAttribute('hostname', $db);
        $this->assertObjectHasAttribute('username', $db);
        $this->assertObjectHasAttribute('password', $db);
        $this->assertObjectHasAttribute('dbname', $db);
        $this->assertObjectHasAttribute('port', $db);
        $this->assertObjectHasAttribute('charset', $db);
    }
    
    public function testPdoObject()
    {
        $dotenv = \Dotenv\Dotenv::createImmutable(__DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR);
        $dotenv->load();

        $db = new MySQL();
        $pdo = $db->connect();

        $this->assertIsObject($pdo);
        $this->assertInstanceOf(\PDO::class, $pdo);
    }
}
