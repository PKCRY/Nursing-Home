<?php
    //start session
    session_start();

    #establishes the connection to the database
    $link = mysqli_connect("localhost", "root", "", "nursing_home");

    #check if connection works
    if ($link === false) {
        die("ERROR: Could not connect. " . mysqli_connect_error());
    }

    //set search session variable
    $_SESSION['srch'] = true;


    //set date session variable
    $_SESSION['date'] = $_POST['date'];


    //redirect back to patient home-page
    header('Location: ../../../templates/home/patient_home.php');

?>
