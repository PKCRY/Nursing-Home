<?php
    #establishes the connection to the database
    $link = mysqli_connect("localhost", "root", "", "nursing_home");

    #check if connection works
    if ($link === false) {
        die("ERROR: Could not connect. " . mysqli_connect_error());
    }


    #validare users that are checked
    foreach($_POST as $key=>$value){
      $accept_sql = <<<EOL
                  DELETE FROM role
                  WHERE role_id = $key;
      EOL;


      mysqli_query($link, $accept_sql);

      #redirect to webpage to show updated users
      header('Location: ../../templates/roles/roles.php');
    }


?>
