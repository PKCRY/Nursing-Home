<!DOCTYPE html>

<html lang="en">
<head>
  <meta charset="utf-8">

  <title>User validation</title>
  <link href="../../assets/styles.css" rel="stylesheet" type="text/css">

</head>

<body class='main-body'>

  <section class='main-section-2'>
    <form action="../../src/auth/logout.php" method="post">
      <input class='submit' type="submit" name="logout" value="Logout">
    </form>

    <form action="../../src/auth/home.php" method="post">
      <input class='submit' type="submit" name="home" value="Home">
    </form>
  </section>

  <section class='main-section'>

    <h1 class='main-header'>User Validation:</h1>

    <form class='main-form' method="POST" action="../../src/register_acceptance/accept.php">

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

        echo "<table>
                <tr>
                  <th>First Name</th>
                  <th>Last Name</th>
                </tr>";

        //loop through all results, enter results into table
        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {

            $f_name = $row['f_name'];
            $user_id = $row['user_id'];

            echo <<<EOL
              <tr>
                <td>{$row['f_name']}</td>
                <td>{$row['l_name']}</td>
                <td>{$row['email']}</td>
                <td>{$row['phone']}</td>
                <td>{$row['dob']}</td>
                <td><input type='checkbox' name='$user_id'></td>
              </tr>
            EOL;
        }

        echo "</table>";
        ?>
        <section>
          <input class='submit' type="Submit" name="accept_sub" value="Accept">
          <input class='submit' type="Submit" name="deny_sub" value="Deny">
        </section>

      </form>
  </section>






</body>
</html>
