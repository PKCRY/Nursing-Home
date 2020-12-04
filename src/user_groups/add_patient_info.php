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
    foreach($_POST as $key=>$value){


      $group_assignment = <<<EOL
                  UPDATE patient_info
                  SET group_id = "$value"
                  WHERE user_id = $key;
      EOL;

      //run query
      mysqli_query($link, $group_assignment);


  }

  //redirect to patient info page
  header('Location: ../../templates/patient_info/additional_patient_info.php');
?>
