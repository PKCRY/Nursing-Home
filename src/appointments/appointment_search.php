<?php
    //start session
    session_start();


    //establishes the connection to the database
    $link = mysqli_connect("localhost", "root", "", "nursing_home");


    //check if connection works
    if ($link === false) {
        die("ERROR: Could not connect. " . mysqli_connect_error());
    }

    //session variable to keep track of searches
    $_SESSION['search'] = true;


    //query to search for specific user
    $_SESSION['patient_query'] = <<<EOL
        SELECT DISTINCT users.f_name, users.l_name, users.user_id, patient_info.group_id,
        patient_info.admission_date
        FROM users, patient_info
        WHERE users.user_id = patient_info.user_id
        AND users.user_id = {$_POST['appointment_patient_id']};
    EOL;

    $_SESSION['doctor_query'] = <<<EOL
        SELECT DISTINCT users.f_name, users.l_name, users.user_id
        FROM users, employee_info
        WHERE users.user_id = employee_info.user_id
        AND users.role_id = 3;
    EOL;

  //redirect back to
  header('Location: ../../templates/patient_info/appointments.php');

?>
