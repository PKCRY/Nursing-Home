<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link href="../../assets/styles.css" rel="stylesheet" type="text/css">
    <title>Family's Homepage</title>

  </head>
  <body>
    <h1>Family Member Homepage</h1>

    <nav class='bubble-nav'>
      <a href="../roster/roster.php">View Roster</a>
    </nav>

    <form action="../../src/auth/logout.php" method="post">
      <input type="submit" name="logout" value="logout">
    </form>

    <form action="../../src/roles/family_backend/family_search.php" method="post">
      <label for="date">Todays Date:</label>
      <?php
      //start session
      session_start();

      #establishes the connection to the database
      $link = mysqli_connect("localhost", "root", "", "nursing_home");

      #check if connection works
      if ($link === false) {
          die("ERROR: Could not connect. " . mysqli_connect_error());
      }

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
      <input type="date" name="date" value="<?php echo $date; ?>" onchange="submit();">

      <label for="fam_code">Family code:</label>
      <input type="text" name="fam_code">

      <label for="patient_id">Patient ID:</label>
      <input type="number" name="patient_id">

      <input type="submit" name="submit" value="Search">

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
        if (isset($_SESSION['validated'])) {
          if ($_SESSION['validated'] === true) {

            //unset session
            unset($_SESSION['validated']);

            //run info query
            $result = mysqli_query($link, $_SESSION['sql']);

            //run appointment check query
            $apt_result = mysqli_query($link, $_SESSION['apt_query']);

            //run group query
            $group_query = mysqli_query($link, $_SESSION['group_query']);
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


            } else {
              echo "<td>There is no checklist for this day.</td>";
            }
          } elseif ($_SESSION['validated'] === false) {
            //unset session
            unset($_SESSION['validated']);

            echo "<p>There were no results with that search criteria, please try again.</p>";
          }
        }
        unset($_SESSION['sql'], $_SESSION['apt_query'], $_SESSION['group_query']);
        ?>
      </tr>
    </table>

  </body>
</html>
