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
    SELECT u.user_id, u.f_name, u.l_name, r.role_name, e.salary
    FROM users u, employee_info e, role r
    WHERE u.user_id = e.user_id AND
    r.role_id = u.role_id AND
    u.user_id LIKE '{$_POST['s_id']}' AND
    u.f_name LIKE '{$_POST['s_f_name']}' AND
    u.l_name LIKE '{$_POST['s_l_name']}' AND
    e.salary LIKE '{$_POST['s_salary']}' AND
    r.role_id LIKE '{$_POST['s_role_name']}';

    EOL;

    //redirect to page
    header('Location: ../../templates/users/employee_details.php');

?>
