<?php
    #establishes the connection to the database
    $link = mysqli_connect("localhost", "root", "", "nursing_home");

    #check if connection works
    if ($link === false) {
        die("ERROR: Could not connect. " . mysqli_connect_error());
    }


    #validare users that are checked
    $sql = <<<EOL
    INSERT INTO `role` (`role_name`, `access_level`)
    VALUES ('{$_POST['role_name']}', {$_POST['access_l']});
    EOL;


    mysqli_query($link, $sql);

    #redirect to webpage to show updated users
    header('Location: ../../templates/roles/roles.php');


?>
