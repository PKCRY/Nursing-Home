<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Nursing Home</title>
    </head>
    <body>
        <h1> Welcome to YOUR Nursing Home!</h1>
        <h2>If you are registering a family member please click register</h2>

        <form method="POST" action="patient_register.php">
            <input type="submit" name="register_btn" value="Register">
        </form>

        <h2>If you already have a login please log in with your username and password</h2>

        <form method="POST" action="../src/auth/login.php">
            <p>Email:</p>
            <input type="text" name="email">
            <p>Password:</p>
            <input type="text" name="password">
            <input type="submit" name="pass_sub" value="Log In">
        </form>

        <?php
        session_start();

        #if the user is already logged in, redirect to home page
        if (isset($_SESSION['is_logged_in']) and $_SESSION['is_logged_in'] == true) {
          if ($_SESSION['user_role'] == 1) {
            //if role is admin
            header('Location: home/admin_home.php');
          } elseif ($_SESSION['user_role'] == 2) {
            //if role is supervisor
            header('Location: home/supervisor_home.php');
          } elseif ($_SESSION['user_role'] == 3) {
            //if role is doctor
            header('Location: home/doctor_home.php');
          } elseif ($_SESSION['user_role'] == 4) {
            //if role is caregiver
            header('Location: home/caregiver_home.php');
          } elseif ($_SESSION['user_role'] == 5) {
            //if role is patient
            header('Location: home/patient_home.php');
          } elseif ($_SESSION['user_role'] == 6) {
            //if role is family member
            header('Location: home/family_member_home.php');
          }
        }

        #check if there was a failed login
        if (isset($_SESSION['incorrect_login'])) {
          #if there was, display error message
          if ($_SESSION['incorrect_login'] == true) {
            echo <<<EOL
            <p> Your login credentials were incorrect, please try again. </p>
            EOL;
            $_SESSION['incorrect_login'] = false;
          }
        }
        ?>
    </body>
</html>
