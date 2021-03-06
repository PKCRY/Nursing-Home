<?php
    //start session
   
    session_start();

    #establishes the connection to the database
    $link = mysqli_connect("localhost", "root", "", "nursing_home");

    #check if connection works
    if ($link === false) {
        die("ERROR: Could not connect. " . mysqli_connect_error());
    }

    //check if any inputs were left blank
    foreach ($_POST as $key=>$value) {
      if ($value == ''){
        $_POST[$key] = '%';
      }
    }

    //session variable to track what sql to display
    $_SESSION['search'] = true;

    $_SESSION['doctor_appointment_query'] = <<<EOL
    SELECT DISTINCT a.appointment_id, a.appointment_date, a.comment, a.morning_med, a.afternoon_med, a.night_med, u.f_name, u.l_name, u.user_id
    FROM appointment a, users u
    WHERE u.user_id = a.patient_id 
    AND a.doctor_id = 12
    AND a.appointment_date <= DATE_SUB(CURRENT_DATE(), interval 1 DAY)
    AND u.user_id LIKE '{$_POST['sa_id']}' 
    AND u.f_name LIKE '{$_POST['sa_f_name']}' 
    AND u.l_name LIKE '{$_POST['sa_l_name']}' 
    AND a.appointment_date LIKE '{$_POST['sa_date']}' 
    AND a.comment LIKE '{$_POST['sa_comment']}' 
    AND a.morning_med LIKE '{$_POST['sa_morning']}' 
    AND a.afternoon_med LIKE '{$_POST['sa_afternoon']}' 
    AND a.night_med LIKE '{$_POST['sa_night']}'
    ;



    EOL;

    $upcoming_date = $_POST['s_until_date'];
    $correct_upcoming_date  = strtotime($upcoming_date);
    
    
    $real_upcoming_date = date('Y-m-d', $upcoming_date);



    /*

    #establishes the connection to the database
    $link = mysqli_connect("localhost", "root", "", "nursing_home");

    #check if connection works
    if ($link === false) {
        die("ERROR: Could not connect. " . mysqli_connect_error());
    }

    $_SESSION['date_search'] = true;

    $_SESSION['appointment_date_query'] = <<<EOL
    SELECT a.appointment_date, u.f_name, u.l_name, u.user_id
    FROM appointment a, users u
    WHERE a.appointment_date >= DATE_SUB(CURRENT_DATE(), interval 1 DAY)
    AND a.appointment_date <= "$real_upcoming_date"
    AND u.user_id = a.patient_id
    AND a.doctor_id = 12
    AND a.Completed = 0

    EOL;
    

    echo $_POST['s_until_date'];

   */

    //redirect to page
    header('Location: ../../../templates/roles/doctor/doctors_appointment.php');

 ?>
