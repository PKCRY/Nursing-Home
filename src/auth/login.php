<?php
      session_start();

      #establish connection to database
      $link = mysqli_connect("localhost", "root", "", "nursing_home");

      #check if connection works
      if ($link === false) {
        die("ERROR: Could not connect. " . mysqli_connect_error());
      }

      #set credential variables for user login
      $email = $_POST['email'];
      $password = $_POST['password'];

      #SQL statement to fetch role and user ids
      $sql = <<<EOL
              SELECT role_id, user_id, f_name, l_name
              FROM users
              WHERE email = '$email' AND password = '$password'
              AND validated = 1;
      EOL;

      #run query in database, check if user correctly logged in
      if ($result = mysqli_query($link, $sql)) {
        $row = mysqli_fetch_row($result);
        $count = mysqli_num_rows($result);
      }

      #if there is a result, redirect them to correct page for their role
      if ($count == 1) {

        $_SESSION['is_logged_in'] = true;
        $_SESSION['user_id'] = $row[1];
        $_SESSION['user_role'] = $row[0];
        $_SESSION['user_name'] = $row[2] . ' ' . $row[3];

        if ($row[0] == 1) {
          //if role is admin
          header('Location: ../../templates/home/admin_home.php');
        } elseif ($row[0] == 2) {
          //if role is supervisor
          header('Location: ../../templates/home/supervisor_home.php');
        } elseif ($row[0] == 3) {
          //if role is doctor
          header('Location: ../../templates/home/doctor_home.php');
        } elseif ($row[0] == 4) {
          //if role is caregiver
          header('Location: ../../templates/home/caregiver_home.php');
        } elseif ($row[0] == 5) {
          //if role is patient
          header('Location: ../../templates/home/patient_home.php');
        } elseif ($row[0] == 6) {
          //if role is family member
          header('Location: ../../templates/home/family_member_home.php');
        }
      } else {
        $_SESSION['incorrect_login'] = true;
        // if there isn't a result, redirect to login from again
        header('Location: ../../templates/main.php');
      }

      #close connection to database
      mysqli_close($link);

    ?>
