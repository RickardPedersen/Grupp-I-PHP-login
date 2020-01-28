<?php

require __DIR__ . '/../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR);
$dotenv->load();

$db = new classes\MySQL();
$pdo = $db->connect();

$sql = "SELECT name FROM test WHERE idtest = ?";
$value = 1;
$params = [$value];
$stmt = $pdo->prepare($sql);
$stmt->execute($params);

while ($row = $stmt->fetch()) {
    echo $row['name'] . PHP_EOL;
}
