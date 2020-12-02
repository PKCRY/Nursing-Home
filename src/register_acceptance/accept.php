<?php
    #establishes the connection to the database
    $link = mysqli_connect("localhost", "root", "", "nursing_home");

    #check if connection works
    if ($link === false) {
        die("ERROR: Could not connect. " . mysqli_connect_error());
    }

    #check if user was accepted/denied
    if (isset($_POST['accept_sub'])) {

      #validare users that are checked
      foreach($_POST as $key=>$value){
        $accept_sql = <<<EOL
        UPDATE users
        SET validated = 1
        WHERE user_id = $key;
        EOL;


        mysqli_query($link, $accept_sql);
      }
    } elseif (isset($_POST['deny_sub'])) {

      foreach($_POST as $key=>$value){
        $deny_sql = <<<EOL
        DELETE FROM users
        WHERE user_id = $key;
        EOL;


        mysqli_query($link, $deny_sql);
      }
    }


    #redirect to webpage to show updated users
    header('Location: ../../templates/registration/accept_user.php');
?>
