<?php
    #establishes the connection to the database
    $link = mysqli_connect("localhost", "root", "", "nursing_home");

    #check if connection works
    if ($link === false) {
        die("ERROR: Could not connect. " . mysqli_connect_error());
    }

    #check if user was accepted/denied
    if (isset($_POST['accept_sub'])) {

      #validate users that are checked
      foreach($_POST as $key=>$value){
        $accept_sql = <<<EOL
        UPDATE users
        SET validated = 1
        WHERE user_id = $key;
        EOL;


        mysqli_query($link, $accept_sql);


        $employee_sql = <<<EOL
        SELECT u.role_id
        FROM users u, role r
        WHERE u.user_id = $key AND
        u.role_id = r.role_id;
        EOL;

        $row = mysqli_fetch_array(mysqli_query($link, $employee_sql), MYSQLI_ASSOC);

        //check if user is an employee
        if ($row['role_id'] < 5) {

          //if they are an employee, insert base info
          $employee_info = <<<EOL
          INSERT INTO employee_info (user_id, salary, group_id)
          VALUES ($key, 0, NULL)
          EOL;

          mysqli_query($link, $employee_info);
        }

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
