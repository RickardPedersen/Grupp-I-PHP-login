<?php include 'head.php'; ?>

<?php
function debug_to_console($data)
{
    $output = $data;
    if (is_array($output))
        $output = implode(',', $output);

    echo "<script>console.log('Debug Objects: " . $output . "' );</script>";
}

$error_msg = '';
$usernameOrEmail = '';

if (isset($_POST['submit'])) {
    $usernameOrEmail = $_POST['username'] ?? null;
    $password = $_POST['password'];

    require __DIR__ . '/../vendor/autoload.php';
    $dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR);
    $dotenv->load();
    $db = new classes\MySQL();
    $pdo = $db->connect();

    $user = new classes\Login($usernameOrEmail, $password);
    $userExists = $user->login($pdo);

    if ($userExists['usernameOrEmailMatch'] && $userExists['passwordMatch']) {
        $newSession = new classes\LoggedInClass();
        header('Location: ' . 'logged_in_view.php');
    } else {
        $error_msg = 'Incorrect username or password';
    }
}
?>

<div class="loginContainer">
    <h1>Login</h1>
    <form action="login_view.php" method="POST">
        <div>
            <p class="error"><?php echo $error_msg; ?></p>
            <input type="text" name="username" placeholder="&#xf007 Username or Email" value=<?php echo htmlspecialchars($usernameOrEmail) ?>>
        </div>
        <div>
            <input type="password" name="password" placeholder="&#xf023 Password">
        </div>
        <div>
            <input type="submit" name="submit" class="btn" value="Login">
        </div>
    </form>
</div>

</body>
</html>
