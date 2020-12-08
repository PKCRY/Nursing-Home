<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Patient Appointment Info</title>
  </head>
  <body>
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
                    SELECT DISTINCT a.*, u.f_name, u.l_name, u.user_id
                    FROM appointment a, users u
                    WHERE u.user_id = a.patient_id
                    
                    
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

    <form action="../../../src/roles/doctor_backend/doct_app_search.php" method="post">
      <label for="">Search ID:</label>
      <input type="number" name="sa_id">

      <label for="">Search First Name:</label>
      <input type="text" name="sa_f_name">

      <label for="">Search Last Name:</label>
      <input type="text" name="sa_l_name">

      <label for="">Search Appointment Date:</label>
      <input type="date" name="sa_date">

      <label for="">Search Comment:</label>
      <input type="text" name="sa_comment">

      <label for="">Search Morning Medication:</label>
      <input type="text" name="sa_morning">
      
      <label for="">Search Afternoon Medication:</label>
      <input type="test" name="sa_afternoon">

      <label for="">Search Bedtime Medication:</label>
      <input type="text" name="sa_night">


      <input type="submit" name="search" value="Search">
    </form>
    <button type="submit" name="button" onclick='location.reload()'>Show all</button>


    
    
    <h1>Appointments Until</h1>
    <form action="../../../src/roles/doctor_backend/doct_upcoming.php" method="post">
      <label for="">Upcoming Appointments Until</label>
      <input type="date" name="s_until_date">

    <table>
      
      <tr>
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
            SELECT DISTINCT a.appointment_date, u.f_name, u.l_name, u.user_id
            FROM appointment a, users u
            WHERE a.appointment_date = CURRENT_DATE
            AND u.user_id = a.patient_id
                    
                    
        EOL;
      
        }


      //run query, get result
      $appointment_date_result = mysqli_query($link, $appointment_date_query);

      //loop through all results, enter results into table
      while ($appointment_date_row = mysqli_fetch_array($appointment_date_result, MYSQLI_ASSOC)) {
          
          echo <<<EOL

            <tr>
              <td>{$appointment_date_row['f_name']} {$appointment_date_row['l_name']}</td>
              <td>{$appointment_date_row['appointment_date']}</td>
             
            </tr>

          EOL;
      }

      

      ?>


      
      
    </table>
    <input type="submit" name="search" value="Search">
    </form>
      

  </body>
</html>