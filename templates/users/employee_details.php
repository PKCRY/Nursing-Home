<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Employee Info</title>
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

    <section class="main-section">
      <h1>List of employees:</h1>

      <form class='form-search' action="../../src/users/search_employee.php" method="post">
        <label class='input-label' for="">Search ID:</label>
        <input class='input' type="number" name="s_id">
        <label class='input-label' for="">Seach First Name:</label>
        <input class='input' type="text" name="s_f_name">
        <label class='input-label' for="">Seach Last Name:</label>
        <input class='input' type="text" name="s_l_name">
        <label class='input-label' for="">Seach Role Name:</label>
        <select class='input' name="s_role_name">
          <option value=""></option>
          <option value="1">Admin</option>
          <option value="2">Supervisor</option>
          <option value="3">Doctor</option>
          <option value="4">Caregiver</option>
        </select>
        <label class='input-label' for="">Seach Salary:</label>
        <input class='input' type="text" name="s_salary">

        <input class='submit' type="submit" name="search" value="Search">
      </form>
      <button class='submit' type="submit" name="button" onclick='location.reload()'>Show all</button>

      <table>
        <tr>
          <th>ID</th>
          <th>First Name</th>
          <th>Last Name</th>
          <th>Role</th>
          <th>Salary</th>
        </tr>

      <?php

      #establishes the connection to the database
      $link = mysqli_connect("localhost", "root", "", "nursing_home");

      #check if connection works
      if ($link === false) {
          die("ERROR: Could not connect. " . mysqli_connect_error());
      }


      //start a session
      session_start();

      //check if search was made
      if(isset($_SESSION['search'])) {

        //reset
        unset($_SESSION['search']);

        //set query to custom search then unset query
        $val_sql = $_SESSION['query'];
        unset($_SESSION['query']);

      } else{

        #query to find all employees
        $val_sql = <<<EOL
                    SELECT u.user_id, u.f_name, u.l_name, r.role_name, e.salary
                    FROM users u, employee_info e, role r
                    WHERE u.user_id = e.user_id AND
                    r.role_id = u.role_id;
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
              <td>{$row['role_name']}</td>
              <td>{$row['salary']}</td>
            </tr>

          EOL;
      }
      ?>
      </table>


      <?php

      //check if user is admin, if they are show update form
      if ($_SESSION['user_role'] == 1) {
        echo <<<EOL

        <form class='form-search' action="../../src/users/update_employee.php" method="post">
          <label class='input-label' for="id">ID:</label>
          <input class='input' type="number" name="id">
          <label class='input-label' for="salary">New Salary:</label>
          <input class='input' type="number" name="salary" value="salary">
          <button class='submit' type="submit" name="submit">Update Salary</button>
        </form>
        EOL;

      }

      ?>
    </section>

  </body>
</html>
