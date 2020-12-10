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

    

    $_SESSION['patient_payment'] = $_POST['patient_payment'];
    $patient_id = $_SESSION['patient_payment'];
    echo $patient_id;

    //query to search for specific user
    $_SESSION['appointment_num_sql'] = <<<EOL
        SELECT DISTINCT a.*, p.date_payed
        FROM appointment a, patient_info p
        WHERE p.user_id = a.patient_id
        AND patient_id = $patient_id
        AND a.appointment_date > p.date_payed
    EOL;

    $_SESSION['num_of_days_sql'] = <<<EOL
    SELECT DISTINCT  date_payed
    FROM patient_info 
    WHERE user_id = $patient_id
    EOL;

    $_SESSION['num_of_meds_sql'] = <<<EOL
      SELECT DISTINCT  a.morning_med, a.afternoon_med, a.night_med, a.appointment_date, p.date_payed
      FROM appointment a, patient_info p
      WHERE a.patient_id = p.user_id
      AND a.patient_id = $patient_id
      AND a.appointment_date > p.date_payed
      EOL;
    
    
    
    



    

    

  //redirect back to
  header('Location: ../../../templates/roles/admin/patient_payment.php');

?>