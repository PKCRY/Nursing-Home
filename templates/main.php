<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Nursing Home</title>
        <link href="../assets/styles.css" rel="stylesheet" type="text/css">
    </head>
    <body class='main-body'>
      <section class='main-section'>
        <h1 class='main-header'> Welcome to YOUR Nursing Home!</h1>

        <h2 class='main-header'>If you already have an account please log in with your username and password</h2>

        <form method="POST" action="../src/auth/login.php" class='main-form'>
            <label class='input-label' for="email">Email:</label>
            <input class='input' type="text" name="email">
            <label class='input-label' for="password">Password:</label>
            <input class='input' type="password" name="password">
            <input class='submit' type="submit" name="pass_sub" value="Log In">
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

        <h2 class='main-header'>If you would like to register please click here.</h2>

        <form method="POST" action="registration/patient_register.php">
            <input class='submit' type="submit" name="register_btn" value="Register">
        </form>
      </section>

    </body>
</html>
