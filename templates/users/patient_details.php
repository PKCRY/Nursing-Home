<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Patient Info</title>
  </head>
  <body>
    <h1>List of Patient Information</h1>

    <table>
      <tr>
        <th>ID</th>
        <th>First Name</th>
        <th>Last Name</th>
        <th>DOB</th>
        <th>Emergency Contact</th>
        <th>Emergency Contact Name</th>
        <th>Admission</th>
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
        $val_sql = $_SESSION['query'];
        unset($_SESSION['query']);

      } else{

        #query to find all patients
        $val_sql = <<<EOL
                    SELECT u.user_id, u.f_name, u.l_name, u.dob, p.relation_of_contact, p.emergency_contact, p.admission_date
                    FROM users u, patient_info p
                    WHERE u.user_id = p.user_id;
        EOL;
      }


      //run query, get result
      $result = mysqli_query($link, $val_sql);

      //loop through all results, enter results into table
      while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {

          echo <<<EOL

            <tr>
              <td>{$row['user_id']}</td>
              <td>{$row['f_name']}</td>
              <td>{$row['l_name']}</td>
              <td>{$row['dob']}</td>
              <td>{$row['relation_of_contact']}</td>
              <td>{$row['emergency_contact']}</td>
              <td>{$row['admission_date']}</td>
            </tr>

          EOL;
      }

      ?>
    </table>

    <form action="../../src/users/search_patient.php" method="post">
      <label for="">Search ID:</label>
      <input type="number" name="s_id">
      <label for="">Search First Name:</label>
      <input type="text" name="s_f_name">
      <label for="">Search Last Name:</label>
      <input type="text" name="s_l_name">
      <label for="">Search DOB:</label>
      <input type="date" name="s_dob">
      <label for="">Search Relation:</label>
      <input type="text" name="s_relation">
      <label for="">Search Contact:</label>
      <input type="text" name="s_contact">
      <label for="">Search Admission Date:</label>
      <input type="date" name="s_admission">


      <input type="submit" name="search" value="Search">
    </form>
    <button type="submit" name="button" onclick='location.reload()'>Show all</button>

  </body>
</html>
