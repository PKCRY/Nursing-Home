<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Administrator's Homepage</title>
    <link href="../../assets/styles.css" rel="stylesheet" type="text/css">
  </head>
  <body class='main-body'>
    <section class='main-section'>
      <h1 class='header'>Administrator Homepage</h1>

      <form action="../../src/auth/logout.php" method="post">
        <input class='submit' type="submit" name="logout" value="logout">
      </form>

      <nav class='bubble-nav'>
        <a href="../registration/accept_user.php">Validate Users</a>
        <a href="../users/patient_details.php">Patient List</a>
        <a href="../patient_info/additional_patient_info.php">Additional Patient Information</a>
        <a href="#">Doctor Appointment Information</a>
        <a href="../roles/roles.php">Update/Change Roles</a>
        <a href="../users/employee_details.php">Employee Information</a>
        <a href="../roster/roster.php">View Roster</a>
        <a href="../roster/new_roster.php">Create Roster</a>
        <a href="../patient_info/admins_report.php">Admin Report</a>
        <a href="#">Patient Payment Information</a>
      </nav>

    </section>

  </body>
</html>
