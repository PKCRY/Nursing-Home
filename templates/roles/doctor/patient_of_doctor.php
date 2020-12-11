<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>My Page Title</title>
    <meta name="description" content="My Page Description">
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
    <h1>Your patient</h1>
    <table>
      <tr>
    <th>Appointment ID</th>
      <th>Appointment Date</th>
        <th>Name</th>
        <th>Comment</th>
        <th>Morning Med</th>
        <th>Afternoon Med</th>
        <th>Night Med</th>
      </tr>

    <?php


    session_start();


    //$appointment_id = $_POST['s_appointmend_id'];


    #establishes the connection to the database
    $link = mysqli_connect("localhost", "root", "", "nursing_home");


    #check if connection works
    if ($link === false) {
        die("ERROR: Could not connect. " . mysqli_connect_error());
    }

    foreach ($_POST as $key=>$value) {

        if ($value == 'Prescribe'){
          $appointment_id = $key;

        }
      }

    $doctor_patient_sql = <<<EOL
        SELECT DISTINCT a.*, u.f_name, u.l_name, u.user_id
        FROM appointment a, users u
        WHERE u.user_id = a.patient_id
        AND a.appointment_id = $appointment_id
        AND a.Completed = 0


    EOL;

      //run query

      $doctor_patient_result = mysqli_query($link, $doctor_patient_sql);


      date_default_timezone_set('America/New_York');
      $todays_date = date('Y-m-d');

      while ($doctor_patient_row = mysqli_fetch_array($doctor_patient_result, MYSQLI_ASSOC)) {

        echo <<<EOL

          <tr>
          <td>{$doctor_patient_row['appointment_id']}</td>
          <td>{$doctor_patient_row['appointment_date']}</td>
            <td>{$doctor_patient_row['f_name']} {$doctor_patient_row['l_name']}</td>
            <td>{$doctor_patient_row['comment']}</td>
            <td>{$doctor_patient_row['morning_med']}</td>
            <td>{$doctor_patient_row['afternoon_med']}</td>
            <td>{$doctor_patient_row['night_med']}</td>
          </tr>

        EOL;


        if ($todays_date == $doctor_patient_row['appointment_date']) {
            echo <<<EOL
            <form action="../../../src/roles/doctor_backend/pat_of_doc.php" method="post">




                <label for="">Make a Comment</label>
                <input type="text" name="sa_comment">



                <label for="">Prescribe Morning Medication:</label>
                <input type="text" name="sa_morning">

                <label for="">Prescribe Afternoon Medication:</label>
                <input type="text" name="sa_afternoon">

                <label for="">Prescribe Bedtime Medication:</label>
                <input type="text" name="sa_night">


                <input type="submit" name="$appointment_id" value="Submit">
            </form>
    EOL;
        }else{
            echo <<<EOL
                <p> You may Only change the prescription on the day of the appointment !!</p>
            EOL;
        }
    }



    //$sql_appointment_date = $doctor_patient_result['appointment_date'];
    //echo $sql_appointment_date;



/*
    echo <<<EOL
    <form action="../../../src/roles/doctor_backend/pat_of_doc.php" method="post">




        <label for="">Make a Comment</label>
        <input type="text" name="sa_comment">



        <label for="">Prescribe Morning Medication:</label>
        <input type="text" name="sa_morning">

        <label for="">Prescribe Afternoon Medication:</label>
        <input type="text" name="sa_afternoon">

        <label for="">Prescribe Bedtime Medication:</label>
        <input type="text" name="sa_night">


        <input type="submit" name="$appointment_id" value="Submit">
    </form>
    EOL;
*/
?>
  </section>




</body>
</html>
