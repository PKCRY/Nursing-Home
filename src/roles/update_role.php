<?php
#establishes the connection to the database
$link = mysqli_connect("localhost", "root", "", "nursing_home");

#check if connection works
if ($link === false) {
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
?>
