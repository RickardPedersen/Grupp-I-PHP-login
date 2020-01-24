<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register</title>
    <link rel="stylesheet" href="..\css\styles.css" type="text/css">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"/>
</head>
<body>
    
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
        </form>
            <input type="submit" class="btn" value="Register">
    </div>

</body>
</html>