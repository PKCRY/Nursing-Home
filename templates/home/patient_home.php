<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Patient's Homepage</title>
    <link href="../../assets/styles.css" rel="stylesheet" type="text/css">
    <script type="text/javascript" src="../../assets/main.js" defer></script>

  </head>
  <body class='main-body'>
    <section class='main-section-3'>
      <nav class='bubble-nav'>
        <form action="../../src/auth/logout.php" method="post">
          <input class='submit' type="submit" name="logout" value="logout">
        </form>

        <a href="../roster/roster.php">View Roster</a>
      </nav>
    </section>

    <section class='main-section'>
      <h1>Patient Homepage</h1>


      <?php
      //start session
      session_start();

      echo <<<EOL
      <p> Patient ID: {$_SESSION['user_id']} </p>
      <p> Patient Name: {$_SESSION['user_name']} </p>
      EOL;

      ?>

      <form id="date-submit" action="../../src/roles/patient_backend/patient_home_backend.php" method="post">
        <label class='input-label' for="date">Todays Date:</label>
        <?php
        //check if a search was made
        if (isset($_SESSION['srch'])){
          unset($_SESSION['srch']);

          //use custom query
          $date = $_SESSION['date'];
          unset($_SESSION['date']);

        } else {
          //set todays date
          $date = date("Y-m-d");

        }

        ?>
        <input class='input' type="date" name="date" value="<?php echo $date; ?>" onchange="submit();">

      </form>

      <table>
        <tr>
          <th>Doctor's Name</th>
          <th>Doctor's Appointment</th>
          <th>Caregiver's Name</th>
          <th>Morning Medicine</th>
          <th>Afternoon Medicine</th>
          <th>Night Medicine</th>
          <th>Breakfast</th>
          <th>Lunch</th>
          <th>Dinner</th>
        </tr>

        <tr>
          <?php
          //establishes the connection to the database
          $link = mysqli_connect("localhost", "root", "", "nursing_home");

          #check if connection works
          if ($link === false) {
              die("ERROR: Could not connect. " . mysqli_connect_error());
          }


          //query for todays date
          $query = <<<EOL
          SELECT r.doctor, r.caregiver_1, r.caregiver_2, r.caregiver_3,
          r.caregiver_4, p.morning_med_check, p.afternoon_med_check,
          p.night_med_check, p.breakfast, p.lunch, p.dinner
          FROM patient_records p, roster r
          WHERE p.cur_date = '$date' AND
          p.cur_date = r.date AND
          p.patient_id = {$_SESSION['user_id']};
          EOL;

          //query to see if there's an appointment for today
          $apt_query = <<<EOL
          SELECT *
          FROM patient_records p, appointment a
          WHERE a.patient_id = p.patient_id AND
          a.appointment_date = p.cur_date;
          EOL;

          //query to find user's group
          $group_query = <<<EOL
          SELECT p.group_id
          FROM users u, patient_info p
          WHERE u.user_id = p.user_id AND
          u.user_id = {$_SESSION['user_id']};
          EOL;


          //run info query
          $result = mysqli_query($link, $query);

          //run appointment check query
          $apt_result = mysqli_query($link, $apt_query);

          //run group query
          $group_query = mysqli_query($link, $group_query);
          $group = mysqli_fetch_row($group_query);

          //check if there's a checklist for that day
          if (mysqli_num_rows($result) > 0) {
            //get results
            $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

            //replace caregiver/doctor id with real name
            foreach ($row as $key => $value) {

              //if user is doctor or caregiver, get real name
              if ($key == 'doctor' or $key == 'caregiver_1' or $key == 'caregiver_2' or $key == 'caregiver_3' or $key == 'caregiver_4') {
                $qry = <<< EOL
                SELECT f_name, l_name
                FROM users
                WHERE user_id = $value
                EOL;

                $res = mysqli_fetch_row(mysqli_query($link, $qry));

                $row[$key] = $res[0] . ' ' . $res[1];

              }
            }

            echo "<tr>";

            echo "<td>{$row['doctor']}</td>";

            //check if there's an appointment that day
            if (mysqli_num_rows($apt_result) > 0) {
              echo "<td><input type='checkbox' disabled='disabled' checked='checked'></td>";
            } else {
              echo "<td><input type='checkbox' disabled='disabled'></td>";
            }

            //check which caregiver was assigned
            if ($group[0] == 1) {
              echo "<td>{$row['caregiver_1']}</td>";
            } elseif ($group[0] == 2) {
              echo "<td>{$row['caregiver_2']}</td>";
            } elseif ($group[0] == 3) {
              echo "<td>{$row['caregiver_3']}</td>";
            } elseif ($group[0] == 4) {
              echo "<td>{$row['caregiver_4']}</td>";
            }


            //check morning meds
            if ($row['morning_med_check'] == 1) {
              echo "<td><input type='checkbox' disabled='disabled' checked='checked'></td>";
            } else {
              echo "<td><input type='checkbox' disabled='disabled'></td>";
            }

            //check afternoon meds
            if ($row['afternoon_med_check'] == 1) {
              echo "<td><input type='checkbox' disabled='disabled' checked='checked'></td>";
            } else {
              echo "<td><input type='checkbox' disabled='disabled'></td>";
            }

            //check night meds
            if ($row['night_med_check'] == 1) {
              echo "<td><input type='checkbox' disabled='disabled' checked='checked'></td>";
            } else {
              echo "<td><input type='checkbox' disabled='disabled'></td>";
            }

            //check breakfast
            if ($row['breakfast'] == 1) {
              echo "<td><input type='checkbox' disabled='disabled' checked='checked'></td>";
            } else {
              echo "<td><input type='checkbox' disabled='disabled'></td>";
            }

            //check lunch
            if ($row['lunch'] == 1) {
              echo "<td><input type='checkbox' disabled='disabled' checked='checked'></td>";
            } else {
              echo "<td><input type='checkbox' disabled='disabled'></td>";
            }

            //check dinner
            if ($row['dinner'] == 1) {
              echo "<td><input type='checkbox' disabled='disabled' checked='checked'></td>";
            } else {
              echo "<td><input type='checkbox' disabled='disabled'></td>";
            }

            echo "</tr>";

          } else {
            echo <<<EOL
            <tr>
              <td>There is no checklist for this day.</td>
            </tr>
            EOL;
          }

          unset($_SESSION['sql'], $_SESSION['apt_query'], $_SESSION['group_query']);

          ?>

        </tr>
      </table>
    </section>

  </body>
</html>
