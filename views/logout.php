<?php
include  __DIR__ . '/../classes/logged_in_view_class.php';

$loggedInClass = new classes\LoggedInClass();

$loggedInClass->logout($_SESSION);

header('Location: ' . 'login_view.php');
