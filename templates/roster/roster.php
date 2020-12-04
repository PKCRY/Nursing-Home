<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Roster</title>
    <script type="text/javascript" src="../../assets/main.js" defer></script>


  </head>
  <body>
    <h1>Current Roster</h1>


    <table>
      <tr>
        <th>Supervisor</th>
        <th>Doctor</th>
        <th>Caregiver 1</th>
        <th>Caregiver 2</th>
        <th>Caregiver 3</th>
        <th>Caregiver 4</th>
      </tr>
      <tr>
        <?php
        //start session
        session_start();

        //establishes the connection to the database
        $link = mysqli_connect("localhost", "root", "", "nursing_home");

        #check if connection works
        if ($link === false) {
            die("ERROR: Could not connect. " . mysqli_connect_error());
        }

        //check if a search was made
        if (isset($_SESSION['srch'])){
          unset($_SESSION['srch']);

          //use custom query
          $query = $_SESSION['qry'];
          unset($_SESSION['qry']);

        } else {
          //set todays date
          $date = date("Y-m-d");

          //query for todays date
          $query = <<<EOL
          SELECT *
          FROM roster
          WHERE date = '$date';
          EOL;
        }

        //run query
        $result = mysqli_query($link, $query);

        if (mysqli_num_rows($result) > 0) {
          //get results
          $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

          echo '<tr>';

          foreach ($row as $key => $value) {

            if ($key != 'roster_id' and $key != 'date') {

              //sql to get employee names
              $sql = <<<EOL
              SELECT f_name, l_name FROM users WHERE user_id = $value;
              EOL;

              //get names of employees
              $res = mysqli_query($link, $sql);
              $test = mysqli_fetch_array($res);

              //create html data
              echo "<td>{$test['f_name']} {$test['l_name']} </td>";

            }
          }

          echo '<tr>';
        } else {
          echo <<<EOL
          <tr>
            <td>There is no roster for this day.</td>
          </tr>
          EOL;
        }


        ?>
      </tr>
    </table>

    <form class="" id='date-submit' action="../../src/roster/search_roster.php" method="post">
      <input type="date" name="date" value="<?php echo $row['date']; ?>" onchange="submit()">
    </form>

  </body>
</html>
