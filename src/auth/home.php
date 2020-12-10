<?php
//start session
session_start();

//check what role the user is, return to home
if ($_SESSION['user_role'] == 1) header('Location: ../../templates/home/admin_home.php'); //admin
elseif ($_SESSION['user_role'] == 2) header('Location: ../../templates/home/supervisor_home.php'); //supervisor
elseif ($_SESSION['user_role'] == 3) header('Location: ../../templates/home/doctor_home.php'); //doctor
elseif ($_SESSION['user_role'] == 4) header('Location: ../../templates/home/caregiver_home.php'); //caregiver
elseif ($_SESSION['user_role'] == 5) header('Location: ../../templates/home/patient_home.php'); //patient
elseif ($_SESSION['user_role'] == 6) header('Location: ../../templates/home/family_member_home.php'); //patient
?>
