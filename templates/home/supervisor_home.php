<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Supervisor's Homepage</title>
    <link href="../../assets/styles.css" rel="stylesheet" type="text/css">
  </head>
  <body class='main-body'>
    <section class='main-section'>
      <h1 class='header'>Supervisor Homepage</h1>

      <form action="../../src/auth/logout.php" method="post">
        <input class='submit' type="submit" name="logout" value="logout">
      </form>

      <nav class='bubble-nav'>
        <a href="../users/patient_details.php">Patient List</a>
        <a href="../users/employee_details.php">Employee Information</a>
      </nav>

    </section>
  </body>
</html>
