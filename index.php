<?php

$request = $_SERVER['REQUEST_URI'];

switch ($request) {
    case '/':
        header("Location: views/login_view.php");
        break;
    case '':
        header("Location: views/login_view.php");
        break;
    default:
        http_response_code(404);
        break;
}
