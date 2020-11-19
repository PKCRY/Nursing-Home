<!DOCTYPE html>

<html lang="en">
<head>
  <meta charset="utf-8">

  <title>User validation</title>
</head>

<body>
  <h1>User Validation:</h1>

  <form method="POST" action="../src/register_acceptance/accept.php">

      <?php
      #establishes the connection to the database
      $link = mysqli_connect("localhost", "root", "", "nursing_home");

      #check if connection works
      if ($link === false) {
          die("ERROR: Could not connect. " . mysqli_connect_error());
      }

      #query to find all unvalidated users
      $val_sql = <<<EOL
                  SELECT f_name, l_name, user_id, email, phone, dob, validated
                  FROM users
                  WHERE validated = 0;
      EOL;

      //run query, get result
      $result = mysqli_query($link, $val_sql);

      //loop through all results, enter results into table
      while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {

          $f_name = $row['f_name'];
          $user_id = $row['user_id'];

          echo <<<EOL
          <table border='1'>
            <tr>
              <th>First Name</th>
              <th>Last Name</th>
            </tr>
            <tr>
              <td>{$row['f_name']}</td>
              <td>{$row['l_name']}</td>
              <td>{$row['email']}</td>
              <td>{$row['phone']}</td>
              <td>{$row['dob']}</td>
              <td><input type='checkbox' name='$user_id'></td>
            </tr>
          </table>
          EOL;
      }
      ?>

      <input type="Submit" name="accept_sub" value="submit">
    </form>




</body>
</html>
