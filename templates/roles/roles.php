<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Roles</title>
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
      <h1>Update/Check Roles</h1>

      <form action="../../src/roles/delete_role.php" method="post">
        <table>
          <tr>
            <th>Role Name</th>
            <th>Access Level</th>
          </tr>
        <?php

        #establishes the connection to the database
        $link = mysqli_connect("localhost", "root", "", "nursing_home");

        #check if connection works
        if ($link === false) {
            die("ERROR: Could not connect. " . mysqli_connect_error());
        }

        #query to find all unvalidated users
        $val_sql = <<<EOL
                    SELECT role_name, access_level, role_id
                    FROM role
        EOL;

        //run query, get result
        $result = mysqli_query($link, $val_sql);

        //loop through all results, enter results into table
        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {

            echo <<<EOL
              <tr>
                <td>{$row['role_name']}</td>
                <td>{$row['access_level']}</td>
                <td><input type='checkbox' name='{$row['role_id']}'></td>
              </tr>
            EOL;
        }
        ?>
        </table>
        <input class='submit' type="submit" value="Remove">
      </form>

      <form class='form-search' action="../../src/roles/create_role.php" method="post">
        <label class='input-label' for="role_name">Insert Role Name:</label>
        <input class='input' type="text" name="role_name">
        <label class='input-label' for="access_l">Insert Access Level:</label>
        <input class='input' type="number" name="access_l">
        <input class='submit' type="submit" value="Add Role">
      </form>
    </section>
  </body>
</html>
