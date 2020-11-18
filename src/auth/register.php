<?php
  session_start();

  $link = mysqli_connect("localhost", "root", "", "nursing_home");

  #check if connection works
  if ($link === false) {
    die("ERROR: Could not connect. " . mysqli_connect_error());
  }

  //set all variables to insert
  $fname = $_POST['f_name'];
  $lname = $_POST['l_name'];
  $role = $_POST['role'];
  $email = $_POST['p_email'];
  $phone = $_POST['phone_number'];
  $password = $_POST['password'];
  $phone = $_POST['phone_number'];
  $DOB = $_POST['DOB'];
  $today = date("Y-m-d");

  if ($role == 'admin') {
    $role = 1;
  } elseif ($role == 'supervisor') {
    $role = 2;
  } elseif ($role == 'doctor') {
    $role = 3;
  } elseif ($role == 'caregiver') {
    $role = 4;
  } elseif ($role == 'patient') {
    $role = 5;
  } elseif ($role == 'family_member') {
    $role = 6;
  }

  echo $role;


  //query to insert user into database
  $sql = <<<EOL
  INSERT INTO `users` (`role_id`, `f_name`, `l_name`, `email`, `phone`, `password`, `dob`, `validated`)
  VALUES ('$role', '$fname', '$lname', '$email', '$phone', '$password', '$DOB', 0);
  EOL;

  //run query
  mysqli_query($link, $sql);

  //check if role us patient
  if ($role == 5) {
    //get patient only data
    $f_code = $_POST['f_code'];
    $e_contact = $_POST['e_contact'];
    $relation = $_POST['relation'];

    //query to find which user to reference in patient_info
    $sql = <<<EOL
    SELECT user_id
    FROM users
    WHERE email = '$email';
    EOL;

    //run query
    if ($result = mysqli_query($link, $sql)) {
      $row = mysqli_fetch_row($result);
      $user_id = $row[0];
    }

    //new query to insert data into patient_info
    $sql = <<<EOL
    INSERT INTO `patient_info` (`user_id`, `family_code`, `emergency_contact`, `relation_of_contact`, `admission_date`)
    VALUES ($user_id, '$f_code', '$e_contact', '$relation', '$today');
    EOL;

    //run query
    mysqli_query($link, $sql);

  }
echo 'done';

?>
