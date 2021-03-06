<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Patient Appointment Info</title>
    <link href="../../../assets/styles.css" rel="stylesheet" type="text/css">

  </head>
  <body class='main-body'>

    <section class='main-section-2'>
      <form action="../../../src/auth/logout.php" method="post">
        <input class='submit' type="submit" name="logout" value="Logout">
      </form>

      <form class='form-search' action="../../../src/auth/home.php" method="post">
        <input class='submit' type="submit" name="home" value="Home">
      </form>
    </section>

    <section class='main-section'>
      <h1>Doctors List of Patient Information</h1>

      <table>
        <tr>
          <th>ID</th>
          <th>First Name</th>
          <th>Last Name</th>
          <th>Appointment Date</th>
          <th>Comment</th>
          <th>Morning Med</th>
          <th>Afternoon Med</th>
          <th>Night Med</th>
        </tr>

        <?php
        //start session
        session_start();

        #establishes the connection to the database
        $link = mysqli_connect("localhost", "root", "", "nursing_home");

        #check if connection works
        if ($link === false) {
            die("ERROR: Could not connect. " . mysqli_connect_error());
        }

        //check if search was made
        if(isset($_SESSION['search'])) {

          //reset
          unset($_SESSION['search']);

          //set query to custom search, then unset query
          $appointment_view_query = $_SESSION['doctor_appointment_query'];
          unset($_SESSION['doctor_appointment_query']);

        } else{
          //$doctor_id = $_SESSION['user_id'];
          //echo "this is the doctor id: " . $doctor_id;


          #query to find all appointments
          $appointment_view_query = <<<EOL
                      SELECT DISTINCT a.appointment_id, a.appointment_date, a.comment, a.morning_med, a.afternoon_med, a.night_med, u.f_name, u.l_name, u.user_id
                      FROM appointment a, users u
                      WHERE u.user_id = a.patient_id
                      AND a.appointment_date <= DATE_SUB(CURRENT_DATE(), interval 1 DAY)
                      AND a.doctor_id = 12
                      AND completed = 1


          EOL;
        }



        //run query, get result
        $doctor_search_result = mysqli_query($link, $appointment_view_query);

        //loop through all results, enter results into table
        while ($appointment_row = mysqli_fetch_array($doctor_search_result, MYSQLI_ASSOC)) {

            echo <<<EOL
              <tr>
                <td>{$appointment_row['user_id']}</td>
                <td>{$appointment_row['f_name']}</td>
                <td>{$appointment_row['l_name']}</td>
                <td>{$appointment_row['appointment_date']}</td>
                <td>{$appointment_row['comment']}</td>
                <td>{$appointment_row['morning_med']}</td>
                <td>{$appointment_row['afternoon_med']}</td>
                <td>{$appointment_row['night_med']}</td>
              </tr>
            EOL;
        }



        ?>
      </table>

      <form class='form-search' action="../../../src/roles/doctor_backend/doct_app_search.php" method="post">
        <label class='input-label' for="">Search ID:</label>
        <input class='input' type="number" name="sa_id">

        <label class='input-label' for="">Search First Name:</label>
        <input class='input' type="text" name="sa_f_name">

        <label class='input-label' for="">Search Last Name:</label>
        <input class='input' type="text" name="sa_l_name">

        <label class='input-label' for="">Search Appointment Date:</label>
        <input class='input' type="date" name="sa_date">

        <label class='input-label' for="">Search Comment:</label>
        <input class='input' type="text" name="sa_comment">

        <label class='input-label' for="">Search Morning Medication:</label>
        <input class='input' type="text" name="sa_morning">

        <label class='input-label' for="">Search Afternoon Medication:</label>
        <input class='input' type="test" name="sa_afternoon">

        <label class='input-label' for="">Search Bedtime Medication:</label>
        <input class='input' type="text" name="sa_night">


        <input class='submit' type="submit" name="search" value="Search">
      </form>
      <button class='submit' type="submit" name="button" onclick='location.reload()'>Show all</button>




      <h1>Appointments Until</h1>
      <form action="../../../src/roles/doctor_backend/doct_upcoming.php" method="post">
        <label class='input-label' for="">Upcoming Appointments Until</label>
        <input class='input' type="date" name="s_until_date">
        <input class='submit' type="submit" name="search" value="Search">

      </form>

      <table>

        <tr>
          <th>Appointment Id</th>
          <th>Patient</th>
          <th>Date</th>
        </tr>

        <?php


          #establishes the connection to the database
          $link = mysqli_connect("localhost", "root", "", "nursing_home");

          #check if connection works
          if ($link === false) {
              die("ERROR: Could not connect. " . mysqli_connect_error());
          }

          //check if search was made
          if(isset($_SESSION['date_search'])) {

            //reset
            unset($_SESSION['date_search']);

            //set query to custom search, then unset query
            $appointment_date_query = $_SESSION['appointment_date_query'];
            unset($_SESSION['appointment_date_query']);

          } else{


          #query to find all appointments
          $appointment_date_query = <<<EOL
              SELECT DISTINCT a.appointment_date, a.appointment_id, u.f_name, u.l_name, u.user_id
              FROM appointment a, users u
              WHERE a.appointment_date = DATE_SUB(CURRENT_DATE(), interval 1 DAY)
              AND u.user_id = a.patient_id
              AND a.doctor_id = 12
              AND a.completed = 0


          EOL;

          }


        //run query, get result
        $appointment_date_result = mysqli_query($link, $appointment_date_query);

        //loop through all results, enter results into table
        while ($appointment_date_row = mysqli_fetch_array($appointment_date_result, MYSQLI_ASSOC)) {

            echo <<<EOL
              <tr>
              <td>{$appointment_date_row['appointment_id']}</td>
                <td>{$appointment_date_row['f_name']} {$appointment_date_row['l_name']}</td>
                <td>{$appointment_date_row['appointment_date']}</td>
                <td><form action="../doctor/patient_of_doctor.php" method="post">
                <input class='submit' type="submit" name="{$appointment_date_row['appointment_id']}" value="Prescribe">

                </form> </td>


              </tr>
            EOL;
        }



        ?>
      </table>
    </section>


  </body>
</html>
