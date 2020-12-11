<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Caregiver's Homepage</title>
    <link href="../../assets/styles.css" rel="stylesheet" type="text/css">
    <script type="text/javascript" src="../../assets/main.js" defer></script>

  </head>
  <body class='main-body'>
    <section class='main-section-3'>
      <form action="../../src/auth/logout.php" method="post">
        <input class='submit' type="submit" name="logout" value="logout">
      </form>

      <nav class='bubble-nav'>
        <a href="../users/patient_details.php">Patient List</a>
        <a href="../roster/roster.php">View Roster</a>
      </nav>
    </section>

    <section class='main-section'>
      <h1 class='header'>Caregiver Homepage</h1>


      <form action="../../src/roles/caregiver_backend/caregiver_search.php" method="post">
        <label class='input-label' for="user">Todays Patients:</label>
        <select class='input' name='user' onchange="submit();">
          <option value="blank"></option>
          <?php
          //start session
          session_start();

          //establishes the connection to the database
          $link = mysqli_connect("localhost", "root", "", "nursing_home");

          #check if connection works
          if ($link === false) {
              die("ERROR: Could not connect. " . mysqli_connect_error());
          }

          //query to get caregivers group_id
          $sql = <<<EOL
          SELECT e.group_id FROM employee_info e, users u WHERE u.user_id = e.user_id AND u.user_id = {$_SESSION['user_id']};
          EOL;

          $res = mysqli_fetch_row(mysqli_query($link, $sql));

          $group_id = $res[0];

          //query to get caregivers patients
          $sql = <<<EOL
          SELECT u.*
          FROM users u, patient_info p, employee_info e
          WHERE u.user_id = p.user_id AND
          p.group_id = e.group_id AND
          e.group_id = $group_id;
          EOL;

          $res = mysqli_query($link, $sql);

          $count = 1;
          while ($ans = mysqli_fetch_array($res, MYSQLI_ASSOC)) {
            if ($count == 1) $user_id = $ans['user_id'];
            echo "<option value='{$ans['user_id']}'>{$ans['f_name']} {$ans['l_name']}</option>";
            $count++;
          }

          ?>


        </select>
      </form>


      <form action="../../src/roles/caregiver_backend/caregiver_record_input.php" method="post">
        <table>
          <tr>
            <th>Name</th>
            <th>Morning Medicine</th>
            <th>Afternoon Medicine</th>
            <th>Night Medicine</th>
            <th>Breakfast</th>
            <th>Lunch</th>
            <th>Dinner</th>
          </tr>
          <tr>
            <?php
            if (isset($_SESSION['srch'])) {
              //unset session
              unset($_SESSION['srch']);


              //set sql, unset session
              $sql = $_SESSION['sql'];
              unset($_SESSION['sql']);

              //get results
              $result = mysqli_query($link, $sql);
              $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

              $user_id = $row['patient_id'];

            } else {
              //get todays date
              $date = date("Y-m-d");

              //check if patient has checklist
              $patient_check = <<<EOL
              SELECT *
              FROM patient_records
              WHERE patient_id = $user_id AND
              cur_date = '$date';
              EOL;


              //run query
              $result = mysqli_query($link, $patient_check);


              //if patient does have a checklist, show it
              if (mysqli_num_rows($result) > 0) {
                $sql = <<<EOL
                SELECT u.f_name, u.l_name, p.morning_med_check, p.afternoon_med_check,
                p.night_med_check, p.breakfast, p.lunch, p.dinner
                FROM patient_records p, roster r, users u
                WHERE p.cur_date = '$date' AND
                p.cur_date = r.date AND
                p.patient_id = $user_id AND
                p.patient_id = u.user_id;
                EOL;

                //get results
                $result = mysqli_query($link, $sql);
                $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

              } elseif (mysqli_num_rows($result) == 0) {
                //if there isn't a checklist for today, make on and refresh page
                $sql_t = <<<EOL
                INSERT INTO patient_records (patient_id, morning_med_check, afternoon_med_check,
                night_med_check, breakfast, lunch, dinner, cur_date)
                VALUES ($user_id, 0, 0, 0, 0, 0, 0, '$date');
                EOL;

                mysqli_query($link, $sql_t);

                header('Location: '.$_SERVER['REQUEST_URI']);
              }
            }

            //display name
            echo "<td>{$row['f_name']} {$row['l_name']}</td>";

            //check morning meds
            if ($row['morning_med_check'] == 1) {
              echo "<td><input type='checkbox' name='morn_med' checked='checked'></td>";
            } else {
              echo "<td><input name='morn_med' type='checkbox'></td>";
            }

            //check afternoon meds
            if ($row['afternoon_med_check'] == 1) {
              echo "<td><input name='afternoon_med' type='checkbox'checked='checked'></td>";
            } else {
              echo "<td><input name='afternoon_med' type='checkbox'></td>";
            }

            //check night meds
            if ($row['night_med_check'] == 1) {
              echo "<td><input name='night_med' type='checkbox' checked='checked'></td>";
            } else {
              echo "<td><input name='night_med' type='checkbox'></td>";
            }

            //check breakfast
            if ($row['breakfast'] == 1) {
              echo "<td><input name='breakfast' type='checkbox' checked='checked'></td>";
            } else {
              echo "<td><input name='breakfast' type='checkbox'></td>";
            }

            //check lunch
            if ($row['lunch'] == 1) {
              echo "<td><input name='lunch' type='checkbox' checked='checked'></td>";
            } else {
              echo "<td><input name='lunch' type='checkbox'></td>";
            }

            //check dinner
            if ($row['dinner'] == 1) {
              echo "<td><input name='dinner' type='checkbox' checked='checked'></td>";
            } else {
              echo "<td><input name='dinner' type='checkbox'></td>";
            }


            unset($_SESSION['sql'], $_SESSION['apt_query'], $_SESSION['group_query']);
            ?>
          </tr>
        </table>

        <input class='submit' type="submit" name="<?php echo $user_id; ?>" value="Update">
      </form>

  </body>
</html>
