<?php
session_start();
include 'head.html';
if (isset($_SESSION['username'])) {
    header('Location: ' . 'logged_in_view.php');
}

$error_msg = [];
$username = '';
$email = '';

if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    require __DIR__ . '/../vendor/autoload.php';

    $user = new classes\Register($username, $password, $email);

    $validate = $user->validate();

    if ($validate['allValid']) {
        $dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR);
        $dotenv->load();
        $db = new classes\MySQL();
        $pdo = $db->connect();

        $newUser = $user->addUser($pdo);

        if (!$newUser) {
            $error_msg['duplicated'] = 'Username or email already exists';
        } else {
            header('Location: ' . 'login_view.php');
        }
    } else {
        foreach ($validate as $key => $value) {
            if ($key == 'allValid') {
                break;
            } else {
                $error_msg[$key] = $value;
            }
        }
    }
};
?>

<div class="registerContainer">
    <h1>Register</h1>
    <form action="register_view.php" method="POST">
        <div>
            <?php foreach ($error_msg as $error) {?>
                <p class="error"><?php echo $error; ?></p>
            <?php } ?>
            <input type="email" name="email" placeholder="Email" value=<?php echo htmlspecialchars($email)?>>
        </div>
        <div>
            <input type="text" name="username" placeholder="&#xf007 Username"
            value=<?php echo htmlspecialchars($username) ?>>
        </div>
        <div>
            <input type="password" name="password" placeholder="&#xf023 Password">
        </div>
        <div>
            <input type="submit" name="submit" class="btn" value="Register">
        </div>
    </form>
    <p class="redirect">Already a member? <a href="login_view.php">Login</a></p>
</div>

</body>
</html>
