<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Employee Info</title>
  </head>
  <body>
    <h1>List of employees:</h1>

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

      <form action="../../src/users/update_employee.php" method="post">
        <label for="id">ID:</label>
        <input type="number" name="id">
        <label for="salary">New Salary:</label>
        <input type="number" name="salary" value="salary">
        <button type="submit" name="submit">Update Salary</button>
      </form>
      EOL;

    }

    ?>

    <form action="../../src/users/search_employee.php" method="post">
      <label for="">Search ID:</label>
      <input type="number" name="s_id">
      <label for="">Seach First Name:</label>
      <input type="text" name="s_f_name">
      <label for="">Seach Last Name:</label>
      <input type="text" name="s_l_name">
      <label for="">Seach Role Name:</label>
      <select name="s_role_name">
        <option value=""></option>
        <option value="1">Admin</option>
        <option value="2">Supervisor</option>
        <option value="3">Doctor</option>
        <option value="4">Caregiver</option>
      </select>
      <label for="">Seach Salary:</label>
      <input type="text" name="s_salary">

      <input type="submit" name="search" value="Search">
    </form>
    <button type="submit" name="button" onclick='location.reload()'>Show all</button>


  </body>
</html>
