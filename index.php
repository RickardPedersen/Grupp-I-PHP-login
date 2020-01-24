<?php
require __DIR__ . '/vendor/autoload.php';
include 'classes/db_class.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

$db = new Database(
    getenv('DB_HOST'),
    getenv('DB_USERNAME'),
    getenv('DB_PASSWORD'),
    getenv('DB_NAME'),
    getenv('DB_PORT')
);
$pdo = $db->connect();

$statement = $pdo->query("SELECT * FROM test");
while ($row = $statement->fetch()) {
    echo $row['name'] . PHP_EOL;
}
