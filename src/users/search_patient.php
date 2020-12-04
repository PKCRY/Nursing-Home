<?php
    //start session
    session_start();

    #establishes the connection to the database
    $link = mysqli_connect("localhost", "root", "", "nursing_home");

    #check if connection works
    if ($link === false) {
        die("ERROR: Could not connect. " . mysqli_connect_error());
    }

    //check if any inputs were left blank
    foreach ($_POST as $key=>$value) {
      if ($value == ''){
        $_POST[$key] = '%';
      }
    }

    //session variable to track what sql to display
    $_SESSION['search'] = true;

    $_SESSION['query'] = <<<EOL
    SELECT u.user_id, u.f_name, u.l_name, u.dob, p.emergency_contact, p.relation_of_contact, p.admission_date
    FROM users u, patient_info p
    WHERE u.user_id = p.user_id AND
    u.user_id LIKE '{$_POST['s_id']}' AND
    u.f_name LIKE '{$_POST['s_f_name']}' AND
    u.l_name LIKE '{$_POST['s_l_name']}' AND
    u.dob LIKE '{$_POST['s_dob']}' AND
    p.emergency_contact LIKE '{$_POST['s_contact']}' AND
    p.relation_of_contact LIKE '{$_POST['s_relation']}' AND
    p.admission_date LIKE '{$_POST['s_admission']}';

    EOL;

    //redirect to page
    header('Location: ../../templates/users/patient_details.php');

 ?>
