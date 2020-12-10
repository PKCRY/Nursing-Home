<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Admins Report</title>
    <link href="../../assets/styles.css" rel="stylesheet" type="text/css">
    <script type="text/javascript" src="../../assets/main.js" defer></script>

  </head>
  <body class='main-body'>

    <section class='main-section-2'>
      <form action="../../src/auth/logout.php" method="post">
        <input class='submit' type="submit" name="logout" value="Logout">
      </form>

      <form action="../../src/auth/home.php" method="post">
        <input class='submit' type="submit" name="home" value="Home">
      </form>
    </section>

    <section class=main-section>
      <h1>Admin's Report</h1>

      <h2>Missed Patient Activity</h2>
      <?php
      //start session
      session_start();

      //check if search was made
      if (isset($_SESSION['srch'])) {
        $date = $_SESSION['date'];

      } else {
        $date = date("Y-m-d");
      }

      //show date form
      echo <<<EOL
      <form id="date-submit" action="../../src/users/admin_report.php" method="post">
        <label for="date">Date:</label>
        <input type="date" name="date" value="$date" onchange="submit();">
      </form>
      EOL;

      ?>




      <table>
        <tr>
          <th>Patient's Name</th>
          <th>Doctor's Name</th>
          <th>Caregiver's Name</th>
          <th>Morning Medicine</th>
          <th>Afternoon Medicine</th>
          <th>Night Medicine</th>
          <th>Breakfast</th>
          <th>Lunch</th>
          <th>Dinner</th>
        </tr>
          <?php
          //establishes the connection to the database
          $link = mysqli_connect("localhost", "root", "", "nursing_home");

          #check if connection works
          if ($link === false) {
              die("ERROR: Could not connect. " . mysqli_connect_error());
          }

          //check if a search was made, if not default
          if (isset($_SESSION['srch'])) {
            unset($_SESSION['srch']);

            //set query and date
            $date = $_SESSION['date'];
            $sql = $_SESSION['sql'];

            //unset session variables
            unset($_SESSION['date']);
            unset($_SESSION['sql']);
          } else {
            $date = date("Y-m-d");

            //sql to check missed patient checks
            $sql = <<<EOL
            SELECT * FROM patient_records
            WHERE cur_date = '$date' AND
            (morning_med_check = 0 OR
            afternoon_med_check = 0 OR
            night_med_check = 0 OR
            breakfast = 0 OR
            lunch = 0 OR
            dinner = 0);
            EOL;


          }

          //run query
          $res = mysqli_query($link, $sql);

          //sql to check who was on the roster that day
          $roster_sql = <<<EOL
          SELECT * FROM roster
          WHERE date = '$date';
          EOL;

          $roster_res = mysqli_query($link, $roster_sql);
          $roster_ans = mysqli_fetch_array($roster_res, MYSQLI_ASSOC);

          //loop through missed check results
          while ($pats = mysqli_fetch_array($res, MYSQLI_ASSOC)) {

            echo "<tr>";
            //sql to get patient group_id
            $group_sql = <<<EOL
            SELECT group_id
            FROM patient_info
            WHERE user_id = {$pats['patient_id']};
            EOL;

            $temp_res = mysqli_query($link, $group_sql);
            $ans = mysqli_fetch_row($temp_res);
            $group_id = $ans[0];

            //replace patient_id with name
            $name_sql = <<<EOL
            SELECT f_name, l_name FROM users WHERE user_id = {$pats['patient_id']};
            EOL;

            $name_res = mysqli_query($link, $name_sql);
            $name = mysqli_fetch_row($name_res);
            $pats["patient_id"] = $name[0] . ' ' . $name[1];

            //doctor_id -> name
            $name_sql = <<<EOL
            SELECT f_name, l_name FROM users WHERE user_id = {$roster_ans['doctor']};
            EOL;

            $name_res = mysqli_query($link, $name_sql);
            $name = mysqli_fetch_row($name_res);
            $doctor_name = $name[0] . ' ' . $name[1];

            //caregivers_id -> name
            $caregivers = array();
            for ($i=1; $i < 5; $i++) {
              $name_sql = <<<EOL
              SELECT f_name, l_name FROM users WHERE user_id = {$roster_ans["caregiver_$i"]};
              EOL;

              $name_res = mysqli_query($link, $name_sql);
              $name = mysqli_fetch_row($name_res);
              $caregiver = $name[0] . ' ' . $name[1];
              array_push($caregivers, $caregiver);
            }

            //show html elements
            echo "<td>{$pats['patient_id']}</td>";
            echo "<td>$doctor_name</td>";

            //use group_id to get that days caregiver
            if ($group_id == 1) {
              echo "<td>{$caregivers[0]}</td>";
            } elseif ($group_id == 2) {
              echo "<td>{$caregivers[1]}</td>";
            } elseif ($group_id == 3) {
              echo "<td>{$caregivers[2]}</td>";
            } elseif ($group_id == 4) {
              echo "<td>{$caregivers[3]}</td>";
            }

            //check morning meds
            if ($pats['morning_med_check'] == 1) {
              echo "<td><input type='checkbox' disabled='disabled' checked='checked'></td>";
            } else {
              echo "<td><input type='checkbox' disabled='disabled'></td>";
            }

            //check afternoon meds
            if ($pats['afternoon_med_check'] == 1) {
              echo "<td><input type='checkbox' disabled='disabled' checked='checked'></td>";
            } else {
              echo "<td><input type='checkbox' disabled='disabled'></td>";
            }

            //check night meds
            if ($pats['night_med_check'] == 1) {
              echo "<td><input type='checkbox' disabled='disabled' checked='checked'></td>";
            } else {
              echo "<td><input type='checkbox' disabled='disabled'></td>";
            }

            //check breakfast
            if ($pats['breakfast'] == 1) {
              echo "<td><input type='checkbox' disabled='disabled' checked='checked'></td>";
            } else {
              echo "<td><input type='checkbox' disabled='disabled'></td>";
            }

            //check lunch
            if ($pats['lunch'] == 1) {
              echo "<td><input type='checkbox' disabled='disabled' checked='checked'></td>";
            } else {
              echo "<td><input type='checkbox' disabled='disabled'></td>";
            }

            //check dinner
            if ($pats['dinner'] == 1) {
              echo "<td><input type='checkbox' disabled='disabled' checked='checked'></td>";
            } else {
              echo "<td><input type='checkbox' disabled='disabled'></td>";
            }


            echo "</tr>";
          }
          ?>
      </table>
    </section>

  </body>
</html>
