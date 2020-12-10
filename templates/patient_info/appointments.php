<!doctype html>
<html lang="en">
  <head>
      <meta charset="utf-8">
      <title>My Page Title</title>
      <meta name="description" content="My Page Description">
      <link href="../../assets/styles.css" rel="stylesheet" type="text/css">

  </head>
  <body class="main-body">

    <section class='main-section-2'>
      <form action="../../src/auth/logout.php" method="post">
        <input class='submit' type="submit" name="logout" value="Logout">
      </form>

      <form action="../../src/auth/home.php" method="post">
        <input class='submit' type="submit" name="home" value="Home">
      </form>
    </section>

    <section class="main-section">
      <h1>Make A New Appointment</h1>
      <form method="POST" action="../../src/appointments/appointment_search.php">
          <label for="appointment_patient_id">Type Patient ID Here</label>
          <input type="number" name="appointment_patient_id" id="appointment_patient_id" value="$user_id">
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
          //set patient_query to session query
          $patient_query = $_SESSION['patient_query'];

          //set doctor query to session query
          $doctor_query = $_SESSION['doctor_query'];

          //unset session query
          unset($_SESSION['patient_query']);
          unset($_SESSION['doctor_query']);


          //run query, get result
          $patient_result = mysqli_query($link, $patient_query);
          $patient_row = mysqli_fetch_row($patient_result);


          //set variables
          $_SESSION['appointment_patient_id'] = $patient_row[2];
          $user_id = $patient_row[2];
          $group_id = $patient_row[3];
          $admission_date = $patient_row[4];
          $patient_name = $patient_row[0] . " " . $patient_row[1];


          //form for making the appointment
          echo <<< EOL
            <form method="POST" action="../../src/appointments/appointment_backend.php"
              <p name='$user_id' id='$user_id' value='$user_id'>$patient_name</p>
              <label for="appoint_date">Select the Appointment Date</label>
              <input type="date" id="appoint_date", name="appoint_date">
          EOL;

          $doctor_result = mysqli_query($link, $doctor_query);


          //sets up the dropdown menu initially
          echo <<<EOL
              <label for="doctor_select">Select the Doctor</label>
              <select name="doctor_select" id="doctor_select">
                  <option name="empty_doctor" value="empty_doctor"></option>

          EOL;
          // puts all of the doctors into the dropdown menu
          while ($doctor_row = mysqli_fetch_array($doctor_result, MYSQLI_ASSOC)) {
            $doctor_name = $doctor_row['f_name'];
            $doctor_id = $doctor_row['user_id'];
            echo <<<EOL
                <option name="$doctor_name" value="$doctor_id">$doctor_name</option>
            EOL;
          }

          echo <<<EOL
                </select>
                <input type="Submit" name="make_appointment" value="Schedule Appointment">
              </form>
          EOL;
      }
    ?>
    </section>



  </body>
</html>
