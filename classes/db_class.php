<?php

namespace classes;

class MySQL
{
    private $hostname;
    private $username;
    private $password;
    private $dbname;
    private $port;
    private $charset;

    public function __construct(
        $hostname,
        $username,
        $password,
        $dbname,
        $port
    ) {
        $this->hostname = $hostname;
        $this->username = $username;
        $this->password = $password;
        $this->dbname = $dbname;
        $this->port = $port;
        $this->charset = 'utf8mb4';
    }

    public function connect()
    {
        $options = [
            \PDO::ATTR_ERRMODE            => \PDO::ERRMODE_EXCEPTION,
            \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
            \PDO::ATTR_EMULATE_PREPARES   => false,
        ];

        try {
            $dsn = "mysql:host=$this->hostname;port=$this->port;dbname=$this->dbname;charset=$this->charset";
            $pdo = new \PDO($dsn, $this->username, $this->password, $options);
            return $pdo;
        } catch (\PDOException $e) {
            echo 'Connection failed: ' . $e->getMessage();
        }
    }
}
