<?php

require __DIR__ . '/../vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR);
$dotenv->load();

$db = new classes\MySQL();
$pdo = $db->connect();

$user = new classes\Login('TestUser', '123');

$matches = $user->login($pdo);

if ($matches['usernameOrEmailMatch']) {
    if ($matches['passwordMatch']) {
        echo 'User logged in!' . PHP_EOL;
        echo 'Username: ' . $_SESSION['username'] . PHP_EOL;
        echo 'Email: ' . $_SESSION['email'];
    } else {
        echo 'Wrong password';
    }
} else {
    echo 'Wrong username or email';
}
