<?php
    session_start();

    #establishes the connection to the database
    $link = mysqli_connect("localhost", "root", "", "nursing_home");

    #check if connection works
    if ($link === false) {
        die("ERROR: Could not connect. " . mysqli_connect_error());
    }


    #validare users that are checked
    foreach($_POST as $key=>$value){
      $accept_sql = <<<EOL
                  UPDATE users
                  SET validated = 1
                  WHERE user_id = $key;
      EOL;


      mysqli_query($link, $accept_sql);
      #redirect to site
      header('Location: ../../templates/accept_user.php');
  }
?>
