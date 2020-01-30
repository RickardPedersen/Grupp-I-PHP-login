<?php

session_start();
include  __DIR__ . '/../classes/logged_in_view_class.php';
$loggedInUser = new classes\LoggedInClass();
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <title>Logged in view</title>
        <link rel="stylesheet"
        href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm"
        crossorigin="anonymous">
        <link rel="stylesheet" href="../css/styles.css">
    </head>
    <body>
        <div class="container center-content">
            <h1>You are now logged in!</h1>
<<<<<<< HEAD
            <?php
            $sessionData = $loggedInUser->sendSessionData();

            foreach ($sessionData as $key => $value) {
                if ($key == "username") {
                    echo "<h1>Welcome: $value</h1>";
                }
                if ($key == "email") {
                    echo "<h2>Email: $value</h2>";
                }
                if ($key == "error") {
                    echo "<h2>Error: $value</h2>";
                }
            }
            ?>
            <button class="btn btn-lg btn-success" type="submit" name="button">Logout</button>
=======
            <h1>Session variable:
                <?php
                    echo $loggedIn->sendSessionData();
                ?>
            </h1>
            <a href="login_view.php" class="btn btn-lg btn-success">Logout</a>
>>>>>>> master
        </div>
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
         integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
         crossorigin="anonymous"></script>
         <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
         integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
         crossorigin="anonymous"></script>
         <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
         integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
         crossorigin="anonymous"></script>
    </body>
</html>
