<?php include 'head.php' ?>

<?php
// function debug_to_console($data) 
// {
//     $output = $data;
//     if (is_array($output))
//         $output = implode(',', $output);

//     echo "<script>console.log('Debug Objects: " . $output . "' );</script>";
// }

$error_msg = array('email'=>'', 'username'=>'', 'password'=>'');

if (isset($_POST['submit'])) {
    if (empty($_POST['email'])) {
        $error_msg['email'] = 'Please enter an email';
    } else {
        if (strlen($_POST['email']) > 65) {
            $error_msg['email'] = 'Email cannot be longer than 65 characters';
        } else {
            $email = filter_var($_POST['email'], FILTER_SANITIZE_STRING);
        }
        $email = filter_var($_POST['email'], FILTER_SANITIZE_STRING);
    }

    if (empty($_POST['username'])) {
        $error_msg['username'] = 'Please enter a username';
    } else {
        if (strlen($_POST['username']) > 20) {
            $error_msg['username'] = 'Username cannot be longer than 20 characters';
        } else {
            $username = filter_var($_POST['username'], FILTER_SANITIZE_STRING);
        }
    }

    if (empty($_POST['password'])) {
        $error_msg['password'] = 'Please enter a password';
    } else {
        $password = filter_var($_POST['password'], FILTER_SANITIZE_STRING);
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    }


    if (array_filter($error_msg)) {
        // error messages are displayed
    } else {
        // submit to db + get redirected to login
    }
};
?>

<div class="registerContainer">
    <h1>Register</h1>
    <form action="register_view.php" method="POST">
        <div>
            <p class="error"><?php echo $error_msg['email']; ?></p>
            <input type="email" name="email" placeholder="Email">
        </div>
        <div>
            <p class="error"><?php echo $error_msg['username']; ?></p>
            <input type="text" name="username" placeholder="&#xf007 Username">
        </div>
        <div>
            <p class="error"><?php echo $error_msg['password']; ?></p>
            <input type="password" name="password" placeholder="&#xf023 Password">
        </div>
        <div>
            <input type="submit" name="submit" class="btn" value="Register">
        </div>
    </form>
</div>

</body>
</html>