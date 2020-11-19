<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Administrator's Homepage</title>
  </head>
  <body>
    <h1>Administrator Homepage</h1>

    <form action="../../src/auth/logout.php" method="post">
      <input type="submit" name="logout" value="logout">
    </form>

    <nav id='admin-nav'>
      <a href="../registration/accept_user.php">Validate Users</a>
      <a href="#">Patient List</a>
      <a href="#">Additional Patient Information</a>
      <a href="#">Doctor Appointment Information</a>
      <a href="../roles/roles.php">Update/Change Roles</a>
      <a href="#">Employee Information</a>
      <a href="#">Roster</a>
      <a href="#">Admin Report</a>
      <a href="#">Patient Payment Information</a>
    </nav>


  </body>
</html>
