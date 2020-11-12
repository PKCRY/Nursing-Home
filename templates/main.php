<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>HTML basics</title>
    </head>
    <body>
        <h1> Welcome to YOUR Nursing Home!</h1>
            <h2>If you are registering a family member please click register</h2>
            
        <form method="POST" action="patient_register.php">
            <input type="submit" name="register_btn" value="Register">
        </form>
        <h2>If you already have a login please Log In with your username and password</h2>
        <form method="POST" action="<?php echo $_SERVER['PHP_SELF'];?>">
            <p>Username:</p>
            <input type="text" name="username">
            <p>Password:</p>
            <input type="text" name="password">
            <input type="submit" name="pass_sub" value="Log In">
        
        </form>

        <?php
            require '../src/login.php';
        ?>
    </body>
</html>

