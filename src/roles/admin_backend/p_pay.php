<?php

    //start session
    session_start();


    #establishes the connection to the database
    $link = mysqli_connect("localhost", "root", "", "nursing_home");


    #check if connection works
    if ($link === false) {
        die("ERROR: Could not connect. " . mysqli_connect_error());
    }


    #validate users that are checked
    $payment = $_POST['new_payment'];
    $todays_the_day = date("Y-m-d");
    
    
    





  $final_payment_sql = <<<EOL
  

    UPDATE patient_info
    SET date_payed = "$todays_the_day", 
        payment = $payment
    WHERE user_id = {$_SESSION['patient_payment']}


  EOL;
  
  mysqli_query($link, $final_payment_sql);



  //redirect to appointment page
  header('Location: ../../../templates/roles/admin/patient_payment.php');
?>
