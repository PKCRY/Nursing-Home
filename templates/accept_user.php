<!DOCTYPE html>

<html lang="en">
<head>
  <meta charset="utf-8">

  <title>Accepting Users</title>
</head>

<body>
  <h1>Acceptance</h1>
  
  <form method="POST" action="accept_user.php">
    <?php
        include '../src/register_acceptance/accept.php';
    ?>
  
    <input type="Submit" name="accept_sub" value="submit">


  </form>



</body>
</html>