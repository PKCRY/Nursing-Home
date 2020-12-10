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
    foreach ($_POST as $key=>$value) {
      echo $key;
      echo $value;
        if ($value == 'Submit'){
          $appointment_id = $key;

          
 
        }
      }

      


      $prescription_sql = <<<EOL
                  UPDATE appointment
                  SET morning_med = '{$_POST['sa_morning']}',
                      afternoon_med = '{$_POST['sa_afternoon']}',
                      night_med = '{$_POST['sa_night']}',
                      comment = '{$_POST['sa_comment']}',
                      prescription_date = DATE_SUB(CURRENT_DATE(), interval 1 DAY),
                      Completed = 1
                  WHERE appointment_id = $appointment_id
      EOL;

      //run query
      mysqli_query($link, $prescription_sql);


  

  //redirect to doctors appointment page
  header('Location: ../../../templates/roles/doctor/doctors_appointment.php');
?>
