<?php

require __DIR__ . '/../vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR);
$dotenv->load();

$db = new classes\MySQL();
$pdo = $db->connect();

$user = new classes\Login('TestUser', '12');
var_dump($user->login($pdo));
