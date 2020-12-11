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

      <form action="../../../src/auth/home.php" method="post">
        <input class='submit' type="submit" name="home" value="Home">
      </form>
    </section>

    <section class='main-section'>
      <h1>Payment</h1>
      <form method="POST" action="../../../src/roles/admin_backend/p_pay_search.php">
          <label class='input-label' for="patient_payment">Type Patient ID Here</label>
          <input class='input' type="number" name="patient_payment" id="patient_payment" value="">
          <input class='submit' type="Submit" name="submit_id" value="Find Patient">
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
          $appointment_num_sql = $_SESSION['appointment_num_sql'];

            //run query


            //runs the number of days since
          $num_of_days_sql = $_SESSION['num_of_days_sql'];



          $num_of_meds_sql = $_SESSION['num_of_meds_sql'];




          //unset session query
          unset($_SESSION['appointment_num_sql']);
          unset($_SESSION['num_of_days_sql']);
          unset($_SESSION['num_of_meds_sql']);



          //run query, get result





          //setting up all the num_of appointments
          $appointment_num_result = mysqli_query($link, $appointment_num_sql);
          //this leads down to the big equation with $num_of_appointments * 50
          $num_of_appointments = mysqli_num_rows($appointment_num_result);



          $res = mysqli_fetch_row(mysqli_query($link, $num_of_days_sql));
          $date_payed = $res[0];
          $current_date = date("Y-m-d");



          //equation thats supposed to get the days since last payed
          $origin = new DateTime($current_date);
          $target = new DateTime($date_payed);
          $interval = $origin->diff($target);
          $days_charged =  $interval->format('%a');


          $num_meds_result = mysqli_query($link, $num_of_meds_sql);



          $current = new DateTime($current_date);
          $payed = new DateTime($date_payed);
          $month_interval = $payed->diff($current);
          $prescription_months = $month_interval->format('%m');



          $previous_morning = "";
          $previous_afternoon = "";
          $previous_night = "";

          $med_amount = 0;

          while($meds_row = mysqli_fetch_array($num_meds_result, MYSQLI_ASSOC)) {


              if($meds_row['morning_med'] != 'Not Prescribed' or $meds_row['morning_med'] == $previous_morning ){

                  $med_amount = $med_amount + 1;


                  $previous_morning = $meds_row['morning_med'];

              }
              if($meds_row['afternoon_med'] != 'Not Prescribed' or $meds_row['afternoon_med'] == $previous_afternoon){
                  $med_amount = $med_amount + 1;


                  $previous_afternoon = $meds_row['afternoon_med'];
              }
              if($meds_row['night_med'] != 'Not Prescribed' or $meds_row['night_med'] == $previous_night){
                  $med_amount = $med_amount + 1;

                  $previous_morning = $meds_row['night_med'];

              }

              $meds_row['morning_med'];




            }



              $last_amount_payed_sql = <<<EOL
              SELECT payment
              FROM patient_info
              WHERE user_id = 3

            EOL;

              $payment_result = mysqli_query($link, $last_amount_payed_sql);


              $last_payed_row = mysqli_fetch_row($payment_result);

              $last_payed = $last_payed_row[0];



            //echo "This is already payed: " . $already_payed;

            $total_due = (($num_of_appointments * 50) + ($days_charged * 10) + ($prescription_months * ($med_amount * 5))- $last_payed);




            if($date_payed == $current_date){
                echo "<h1> WHAT ARE YOU DOING? This was already payed Today!</h1>";
            }else{
              echo <<<EOL

              <h1>$total_due</h1>

              <p>Total Due: $total_due</p>
              <form method="POST" action="../../../src/roles/admin_backend/p_pay.php">
                  <label for="patient_payment">New Payment</label>
                  <input type="number" name="new_payment" id="new_payment" value="$000.00">
                  <input type="Submit" name="submit_id" value="Submit Payment">
              </form>
              EOL;
            }




  /*
              echo <<<EOL

              <h1>$total_due</h1>

              <p>Total Due: $total_due</p>
              <form method="POST" action="../../../src/roles/admin_backend/p_pay.php">
                  <label for="patient_payment">New Payment</label>
                  <input type="number" name="new_payment" id="new_payment" value="$000.00">
                  <input type="Submit" name="submit_id" value="Submit Payment">
              </form>
    EOL;
  */
          //form for making the appointment
          /*echo <<< EOL

            <form method="POST" action="../../src/appointments/appointment_backend.php"
            <p name='$user_id' id='$user_id' value='$user_id'>$patient_name</p>
            <label for="appoint_date">Select the Appointment Date</label>
            <input type="date" id="appoint_date", name="appoint_date">


            EOL;
      */
          }
  ?>
    </section>



</body>
</html>
