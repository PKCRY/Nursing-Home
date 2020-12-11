<?php
    //start session
   
    session_start();

    #establishes the connection to the database
    $link = mysqli_connect("localhost", "root", "", "nursing_home");

    #check if connection works
    if ($link === false) {
        die("ERROR: Could not connect. " . mysqli_connect_error());
    }

    
    //session variable to track what sql to display
   
    $_SESSION['date_search'] = true;

    $_SESSION['appointment_date_query'] = <<<EOL
    SELECT a.appointment_date, a.appointment_id, u.f_name, u.l_name, u.user_id
    FROM appointment a, users u
    WHERE a.appointment_date >= DATE_SUB(CURRENT_DATE(), interval 1 DAY)
    AND a.appointment_date <= "{$_POST['s_until_date']}"
    AND u.user_id = a.patient_id
    AND a.doctor_id = 12
    AND a.Completed = 0
    

    EOL;
    

    echo $_POST['s_until_date'];

   

    //redirect to page
    header('Location: ../../../templates/roles/doctor/doctors_appointment.php');

 ?>


