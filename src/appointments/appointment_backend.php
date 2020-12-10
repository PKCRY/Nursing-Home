<?php

    //start session
    session_start();


    #establishes the connection to the database
    $link = mysqli_connect("localhost", "root", "", "nursing_home");


    #check if connection works
    if ($link === false) {
        die("ERROR: Could not connect. " . mysqli_connect_error());
    }

    
   $user_id = $_SESSION['appointment_patient_id'];
    $value_items = array($user_id);


    #validate users that are checked
    foreach($_POST as $key=>$value){
        echo "this is the key: " . "\n";
        print_r($key);
        echo "\n";
        echo "this is the value: " . "\n";
        echo "\n";
        print_r($value);

        array_push($value_items, $value);

    }
    echo "this is the array: ";
    print_r($value_items);



    $appointment_sql = <<<EOL
        INSERT INTO appointment (doctor_id, patient_id, appointment_date, comment, morning_med, afternoon_med, night_med, Completed)
        VALUES ($value_items[2], $value_items[0], "$value_items[1]", "No comment", "Not Prescribed", "Not Prescribed", "Not Prescribed", 0)
            
        
    EOL;

      //run query
      mysqli_query($link, $appointment_sql);


  

  //redirect to appointment page
  header('Location: ../../templates/patient_info/appointments.php');
?>
