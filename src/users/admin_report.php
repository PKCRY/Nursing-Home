<?php
//start session
session_start();

//session variable to track if a search was made/date
$_SESSION['srch'] = true;
$_SESSION['date'] = $_POST['date'];

#establishes the connection to the database
$link = mysqli_connect("localhost", "root", "", "nursing_home");

#check if connection works
if ($link === false) {
    die("ERROR: Could not connect. " . mysqli_connect_error());
}

//set query for search
$_SESSION['sql'] = <<<EOL
SELECT * FROM patient_records
WHERE cur_date = '{$_POST['date']}' AND
(morning_med_check = 0 OR
afternoon_med_check = 0 OR
night_med_check = 0 OR
breakfast = 0 OR
lunch = 0 OR
dinner = 0);
EOL;

//redirect back to roster page
header('Location: ../../templates/patient_info/admins_report.php');

?>
