<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>My Page Title</title>
    <meta name="description" content="My Page Description">
</head>


<!--
Notes

For this page I need the patient id
the group_id and the ability to change it
teh admission date which i have to add
the patient name which will show up when user id is inputted


need to figure out where to put everything so it auto fills when
you input the patient_id

need to find out where to put this form stuff
probably best to put it in the php section

../../src/user_groups/add_patient_info.php
action="<?php #$_SERVER['PHP_SELF'];?> ">
-->

<body>
    <h1>Additional Patient Information</h1>
    <form method="POST" action="../../src/user_groups/search_patient_info.php">
        <label for="add_user_id">Type Patient ID Here</label>
        <input type="number" name="add_user_id" id="add_user_id" value="$user_id">
        <input type="Submit" name="submit_id" value="Find Patient">
    </form>

    <?php

    //start session
    session_start();


    #establishes the connection to the database
    $link = mysqli_connect("localhost", "root", "", "nursing_home");


    //check if connection works
    if ($link === false) {
        die("ERROR: Could not connect. " . mysqli_connect_error());
    }


    if (isset($_SESSION['search'])){

        //remove search session variable
        unset($_SESSION['search']);
        //set query to session query
        $query = $_SESSION['query'];
        //unset session query
        unset($_SESSION['query']);


        //run query, get result
        $result = mysqli_query($link, $query);
        $row = mysqli_fetch_row($result);


        //set variables
        $user_id = $row[2];
        $group_id = $row[3];
        $admission_date = $row[4];
        $patient_name = $row[0] . " " . $row[1];

        echo <<<EOL
        <p name='patient_name' id='patient_name'>$patient_name</p>

        <p name='admission_date' id='admission_date'>The patients Admission Date is $admission_date</p>
        EOL;


        //form for updating patient group
        echo <<< EOL
          <form method="POST" action="../../src/user_groups/add_patient_info.php"
          <label for="groups">Change Patient Group</label>
            <select name="$user_id" id="$user_id">
                        <option name="group_id" value="group_id">$group_id</option>
                        <option name="cyan" value="cyan">Cyan</option>
                        <option name="magenta" value="magenta" >Magenta</option>
                        <option name="yellow" value="yellow" >Yellow</option>
                        <option name="hell" value="hell" >Hell</option>
                    </select>
                <input type="Submit" name="change_group" value="Change Patients Group">
            </form>
          EOL;
    }



?>







</body>
</html>
