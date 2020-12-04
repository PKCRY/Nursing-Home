<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Create Roster</title>
  </head>
  <body>
    <h1>Create Roster</h1>

    <?php
    //start a session
    session_start();

    #establishes the connection to the database
    $link = mysqli_connect("localhost", "root", "", "nursing_home");

    #check if connection works
    if ($link === false) {
        die("ERROR: Could not connect. " . mysqli_connect_error());
    }

    //query to get all employees
    $sql = <<<EOL
    SELECT u.role_id, u.user_id, u.f_name, u.l_name
    FROM users u, employee_info e
    WHERE u.user_id = e.user_id;
    EOL;

    //run query
    $result = mysqli_query($link, $sql);

    //create employee array to store employee references
    $employee_arr = array();

    //populate employee array
    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
      array_push($employee_arr, $row);
    }

    ?>


    <form class="" action="../../src/roster/create_roster.php" method="post">
      <label for="date">Date:</label>
      <input type="date" name="date" value="<?php echo date("Y-m-d");?>">

      <label for="supervisor">Supervisor:</label>
      <select name="supervisor">
        <?php

          //check which employees are supervisors
          foreach ($employee_arr as $arr){
            if ($arr['role_id'] == 2) {
              echo "<option value='{$arr['user_id']}'>{$arr['f_name']} {$arr['l_name']}</option>";
            }
          }

        ?>
      </select>

      <label for="doctor">Doctor:</label>
      <select type="text" name="doctor">
        <?php

          //check which employees are doctor
          foreach ($employee_arr as $arr){
            if ($arr['role_id'] == 3) {
              echo "<option value='{$arr['user_id']}'>{$arr['f_name']} {$arr['l_name']}</option>";
            }
          }

        ?>
      </select>

      <label for="caregiver1">Caregiver 1:</label>
      <select type="text" name="caregiver1">
        <?php

          //check which employees are caregivers
          foreach ($employee_arr as $arr){
            if ($arr['role_id'] == 4) {
              echo "<option value='{$arr['user_id']}'>{$arr['f_name']} {$arr['l_name']}</option>";
            }
          }

        ?>
      </select>

      <label for="caregiver2">Caregiver 2:</label>
      <select type="text" name="caregiver2">
        <?php

          //check which employees are caregivers
          foreach ($employee_arr as $arr){
            if ($arr['role_id'] == 4) {
              echo "<option value='{$arr['user_id']}'>{$arr['f_name']} {$arr['l_name']}</option>";
            }
          }

        ?>
      </select>

      <label for="caregiver3">Caregiver 3:</label>
      <select type="text" name="caregiver3">
        <?php

          //check which employees are caregivers
          foreach ($employee_arr as $arr){
            if ($arr['role_id'] == 4) {
              echo "<option value='{$arr['user_id']}'>{$arr['f_name']} {$arr['l_name']}</option>";
            }
          }

        ?>
      </select>

      <label for="caregiver4">Caregiver 4:</label>
      <select type="text" name="caregiver4">
        <?php

          //check which employees are caregivers
          foreach ($employee_arr as $arr){
            if ($arr['role_id'] == 4) {
              echo "<option value='{$arr['user_id']}'>{$arr['f_name']} {$arr['l_name']}</option>";
            }
          }

        ?>
      </select>

      <input type="submit" name="submit" value="Submit">
    </form>

    <?php
    if (isset($_SESSION['msg'])){
      echo "<p>{$_SESSION['msg']}</p>";
      unset($_SESSION['msg']);
    }
    ?>


  </body>
</html>
