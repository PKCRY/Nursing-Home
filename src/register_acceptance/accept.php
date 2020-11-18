<?php 
    session_start();
    
    #establishes the connection to the database
    $link = mysqli_connect("localhost", "root", "", "nursing_home");
    
    #check if connection works
    if ($link === false) {
        die("ERROR: Could not connect. " . mysqli_connect_error());
    }

$val_sql = <<<EOL
            SELECT f_name, l_name, email, phone, dob, validated
            FROM users
            WHERE validated = 0;
EOL; 



$user_validate = array();
if ($result = mysqli_query($link, $val_sql)) {

    
}

while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
    echo "<table border='1'>
    <tr>
    <th>Firstname</th>
    <th>Lastname</th>
    </tr>";   

    echo "<tr>";
    echo "<td>" . $row['f_name'] . "</td>";
    echo "<td>" . $row['l_name'] . "</td>";
    echo "<td>" . $row['email'] . "</td>";
    echo "<td>" . $row['phone'] . "</td>";
    echo "<td>" . $row['dob'] . "</td>";
    echo "<td><input type='checkbox' name='validate_check[]'  value='0'></td>";
    echo "</tr>";
    
    echo "</table>";
    
}
echo "</table>";

$validator = $_POST['validate_check'];
  if(empty($validator)) 
  {
    echo("You didn't select any patients");
  } 
  else 
  {
    $N = count($validator);

    echo("You selected $N patients(s): ");
    for($i=0; $i < $N; $i++)
    {
        echo "what are you gonna do stab me";
        /*$check_sql = <<<EOL
        
        EOL;*/
        $validator[$i] = "yeah? what of it";
      echo($row["l_name"] . $validator[$i] . " ");
    }
  }





?>