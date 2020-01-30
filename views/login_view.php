<!-- Just for demonstration purposes.-->
<?php
include  __DIR__ . '/../classes/logged_in_view_class.php';

$loggedInClass = new classes\LoggedInClass();

$loggedInClass->logout($_SESSION);
 ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <title>Login view</title>
    </head>
    <body>
        <h1>LOGOUT PAGE</h1>
        <?php print_r($_SESSION); ?>
    </body>
</html>

<?php session_destroy(); ?>
