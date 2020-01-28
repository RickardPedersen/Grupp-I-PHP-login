<?php
session_start();
$_SESSION = array()
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <title></title>
    </head>
    <body>
        <h1>LOGOUT PAGE</h1>
        <?php print_r($_SESSION); ?>
    </body>
</html>

<?php session_destroy(); ?>
