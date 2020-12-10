<!doctype html>
<html lang="en">
  <head>
      <meta charset="utf-8">
      <title>My Page Title</title>
      <link href="../../assets/styles.css" rel="stylesheet" type="text/css">
      <meta name="description" content="My Page Description">

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
      <h1>Patient Group Assignment</h1>


      <form method="POST" action="../../src/user_groups/patient_group.php">
      <?php
        #establishes the connection to the database
        $link = mysqli_connect("localhost", "root", "", "nursing_home");

        #check if connection works
        if ($link === false) {
            die("ERROR: Could not connect. " . mysqli_connect_error());
        }

        #query to find all unvalidated users
        $group_sql = <<<EOL
                  SELECT DISTINCT users.f_name, users.l_name, users.user_id
                  FROM users, patient_info
                  WHERE patient_info.group_id IS NULL
                  AND
                  users.user_id = patient_info.user_id
        EOL;

        //run query, get result
        $result = mysqli_query($link, $group_sql);

        //loop through all results, enter results into table
        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {

            $f_name = $row['f_name'];
            $user_id = $row['user_id'];

            echo <<<EOL
            <table border='1'>
              <tr>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Select Group</th>
              </tr>
              <tr>
                <td>{$row['f_name']}</td>
                <td>{$row['l_name']}</td>
                <td>
                  <select name="$user_id" id="$user_id">
                      <option name="empty" value="empty" ></option>
                      <option name="cyan" value="cyan" >Cyan</option>
                      <option name="magenta" value="magenta" >Magenta</option>
                      <option name="yellow" value="yellow" >Yellow</option>
                      <option name="hell" value="hell" >Hell</option>
                  </select>
              </td>
              </tr>
            </table>
            EOL;
        }


        ?>

        <input type="Submit" name="accept_sub" value="submit">

      </form>
    </section>



  </body>
</html>
