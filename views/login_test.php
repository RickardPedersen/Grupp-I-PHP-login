<?php

require __DIR__ . '/../vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR);
$dotenv->load();

$db = new classes\MySQL();
$pdo = $db->connect();

// create user object, params (username/email, password)
$user = new classes\Login('TestUser', '123');

// login method return array with input matches
$matches = $user->login($pdo);

// check if username or email was a match
if ($matches['usernameOrEmailMatch']) {
    // username or email OK

    // check if password was a match
    if ($matches['passwordMatch']) {
        // password OK
        // session is started from class
        echo 'User logged in!' . PHP_EOL;
        echo 'Username: ' . $_SESSION['username'] . PHP_EOL;
        echo 'Email: ' . $_SESSION['email'];
    } else {
        // wrong password
        echo 'Wrong password';
    }
} else {
    // wrong username or email
    echo 'Wrong username or email';
}
