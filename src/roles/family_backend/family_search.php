<?php
    //start session
    session_start();

    #establishes the connection to the database
    $link = mysqli_connect("localhost", "root", "", "nursing_home");

    #check if connection works
    if ($link === false) {
        die("ERROR: Could not connect. " . mysqli_connect_error());
    }

    //set search session variable
    $_SESSION['srch'] = true;


    //set date session variable
    $_SESSION['date'] = $_POST['date'];


    //check if patient id and family code match
    $patient_check = <<<EOL
    SELECT u.*
    FROM users u, patient_info p
    WHERE u.user_id = {$_POST['patient_id']} AND
    u.user_id = p.user_id AND
    p.family_code = '{$_POST['fam_code']}';
    EOL;


    //run query
    $result = mysqli_query($link, $patient_check);


    //checl if it's a match
    if (mysqli_num_rows($result) > 0) {
      $_SESSION['validated'] = true;

      //query for patient
      $_SESSION['sql'] = <<<EOL
      SELECT r.doctor, r.caregiver_1, r.caregiver_2, r.caregiver_3,
      r.caregiver_4, p.morning_med_check, p.afternoon_med_check,
      p.night_med_check, p.breakfast, p.lunch, p.dinner
      FROM patient_records p, roster r
      WHERE p.cur_date = '{$_POST['date']}' AND
      p.cur_date = r.date AND
      p.patient_id = {$_POST['patient_id']};
      EOL;

      //query to see if there's an appointment for today
      $_SESSION['apt_query'] = <<<EOL
      SELECT *
      FROM patient_records p, appointment a
      WHERE a.patient_id = p.patient_id AND
      a.appointment_date = p.cur_date;
      EOL;

      //query to find user's group
      $_SESSION['group_query'] = <<<EOL
      SELECT p.group_id
      FROM users u, patient_info p
      WHERE u.user_id = p.user_id AND
      u.user_id = {$_POST['patient_id']};
      EOL;

    } else {
      $_SESSION['validated'] = false;
    }

    //redirect back to patient home-page
    header('Location: ../../../templates/home/family_member_home.php');
?>
