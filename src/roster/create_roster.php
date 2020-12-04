<?php
    //start session
    session_start();

    #establishes the connection to the database
    $link = mysqli_connect("localhost", "root", "", "nursing_home");

    #check if connection works
    if ($link === false) {
        die("ERROR: Could not connect. " . mysqli_connect_error());
    }


    //query to insert user into roster
    $sql = <<<EOL
    INSERT INTO roster (supervisor, doctor, caregiver_1, caregiver_2, caregiver_3, caregiver_4, date)
    VALUES ('{$_POST['supervisor']}', '{$_POST['doctor']}', '{$_POST['caregiver1']}', '{$_POST['caregiver2']}',
    '{$_POST['caregiver3']}', '{$_POST['caregiver4']}', '{$_POST['date']}');
    EOL;


    //run query
    if (mysqli_query($link, $sql)) {
      //session variable to track if it worked
      $_SESSION['msg'] = 'Successfully created roster.';
    } else {
      //session variable to track if it worked
      $_SESSION['msg'] = 'There was an error creating your roster.';
    }

    //redirect back to create_roster page
    header('Location: ../../templates/roster/new_roster.php');

?>
