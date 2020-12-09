<?php
    //start session
    session_start();

    //establishes the connection to the database
    $link = mysqli_connect("localhost", "root", "", "nursing_home");

    //set date
    $date = date('Y-m-d');

    //get user_id
    foreach ($_POST as $key => $value) {
      if ($value == 'Update Record') {
        $id = $key;
      }
    }

    #check if connection works
    if ($link === false) {
        die("ERROR: Could not connect. " . mysqli_connect_error());
    }


    //check all post data
    if (!empty($_POST['morn_med'])) {
      $mm = 1;
    } else {
      $mm = 0;
    }

    if (!empty($_POST['afternoon_med'])) {
      $am = 1;
    } else {
      $am = 0;
    }

    if (!empty($_POST['night_med'])) {
      $nm = 1;
    } else {
      $nm = 0;
    }

    if (!empty($_POST['breakfast'])) {
      $b = 1;
    } else {
      $b = 0;
    }
    if (!empty($_POST['lunch'])) {
      $l = 1;
    } else {
      $l = 0;
    }

    if (!empty($_POST['dinner'])) {
      $d = 1;
    } else {
      $d = 0;
    }

    //insert new data
    $sql = <<<EOL
    UPDATE patient_records
    SET morning_med_check = $mm, afternoon_med_check = $am, night_med_check = $nm,
    breakfast = $b, lunch = $l, dinner = $d
    WHERE patient_id = $id AND
    cur_date = '$date';
    EOL;

    //run query
    mysqli_query($link, $sql);

    //redirect
    header('Location: ../../../templates/home/caregiver_home.php');

?>
