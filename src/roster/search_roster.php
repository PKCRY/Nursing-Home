<?php
    //start session
    session_start();

    //session variable to track if a search was made
    $_SESSION['srch'] = true;

    #establishes the connection to the database
    $link = mysqli_connect("localhost", "root", "", "nursing_home");

    #check if connection works
    if ($link === false) {
        die("ERROR: Could not connect. " . mysqli_connect_error());
    }

    //set query for search
    $_SESSION['qry'] = <<<EOL
    SELECT * FROM roster WHERE date = '{$_POST['date']}';
    EOL;

    //redirect back to roster page
    header('Location: ../../templates/roster/roster.php');

?>
