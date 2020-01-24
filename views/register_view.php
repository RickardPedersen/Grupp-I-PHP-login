<?php include 'head.php' ?>

<?php

function debug_to_console($data) 
{
    $output = $data;
    if (is_array($output))
        $output = implode(',', $output);

    echo "<script>console.log('Debug Objects: " . $output . "' );</script>";
}

if (isset($_POST['submit'])) {
    $email = filter_var($_POST['email'], FILTER_SANITIZE_STRING);
    $username = filter_var($_POST['username'], FILTER_SANITIZE_STRING);
    $password = filter_var($_POST['password'], FILTER_SANITIZE_STRING);

    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    debug_to_console($hashedPassword);
};

?>
    
    <div class="registerContainer">
        <h1>Register</h1>
        <form action="register_view.php" method="POST">
            <div>
                <input type="email" name="email" placeholder="Email">
            </div>
            <div>
                <input type="text" name="username" placeholder="&#xf007 Username">
            </div>
            <div>
                <input type="password" name="password" placeholder="&#xf023 Password">
            </div>
            <div>
                <input type="submit" name="submit" class="btn" value="Register">
            </div>
        </form>
            
    </div>

</body>
</html>