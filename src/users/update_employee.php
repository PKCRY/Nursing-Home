<?php
    //start session
    session_start();

    #establishes the connection to the database
    $link = mysqli_connect("localhost", "root", "", "nursing_home");

    #check if connection works
    if ($link === false) {
        die("ERROR: Could not connect. " . mysqli_connect_error());
    }



    //query to update salary for specified employee
    $query = <<<EOL
    UPDATE `employee_info`
    SET salary = {$_POST['salary']}
    WHERE user_id = {$_POST['id']};
    EOL;

    #run query to update user salary
    mysqli_query($link, $query);


    //redirect to page
    header('Location: ../../templates/users/employee_details.php');
?>
