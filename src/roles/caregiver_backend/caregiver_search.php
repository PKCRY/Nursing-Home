<?php
    //start session
    session_start();

    //establishes the connection to the database
    $link = mysqli_connect("localhost", "root", "", "nursing_home");

    #check if connection works
    if ($link === false) {
        die("ERROR: Could not connect. " . mysqli_connect_error());
    }

    //set search session variable
    $_SESSION['srch'] = true;


    //set date session variable
    $_SESSION['date'] = date("Y-m-d");

    //check if patient has checklist
    $patient_check = <<<EOL
    SELECT *
    FROM patient_records
    WHERE patient_id = {$_POST['user']} AND
    cur_date = '{$_SESSION['date']}';
    EOL;


    //run query
    $result = mysqli_query($link, $patient_check);


    //query for patient
    $_SESSION['sql'] = <<<EOL
    SELECT p.patient_id, u.f_name, u.l_name, p.morning_med_check, p.afternoon_med_check,
    p.night_med_check, p.breakfast, p.lunch, p.dinner
    FROM patient_records p, roster r, users u
    WHERE p.cur_date = '{$_SESSION['date']}' AND
    p.cur_date = r.date AND
    p.patient_id = {$_POST['user']} AND
    p.patient_id = u.user_id;
    EOL;


    //if patient doesn't have a record, make one
    if (mysqli_num_rows($result) == 0) {
      $sql = <<<EOL
      INSERT INTO patient_records (patient_id, morning_med_check, afternoon_med_check,
      night_med_check, breakfast, lunch, dinner, cur_date)
      VALUES ({$_POST['user']}, 0, 0, 0, 0, 0, 0, '{$_SESSION['date']}');
      EOL;

      mysqli_query($link, $sql);
    }


    //redirect back to patient home-page
    header('Location: ../../../templates/home/caregiver_home.php');
?>
