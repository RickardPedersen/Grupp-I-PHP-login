<?php

require __DIR__ . '/../vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR);
$dotenv->load();

$db = new classes\MySQL();
$pdo = $db->connect();

/*
* Skapar ett user object
* params (username, password, email)
*/
$user = new classes\Register('TestUser', '123', 'test@mail.com');

// Filtrerar/validerar inputs
$valArr = $user->validate();

// check if all is valid
if ($valArr['allValid']) {
    // inputs OK

    // Försöker lägga till användare i databasen
    if ($user->addUser($pdo)) {
        // Success!
        echo 'User created!';
    } else {
        // Användarnamn och/eller lösenord finns redan i databasen
        echo 'Username or email taken';
    }
} else {
    echo 'Illegal inputs';
}
