<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $fname = $_POST['f_name'];
    $lname = $_POST['l_name'];
    $email = $_POST['p_email'];
    $ph_num = $_POST['phone_number'];
    $password = $_POST['password'];
    $DOB = $_POST['DOB'];
    $f_code = $_POST['f_code'];
    $e_contact = $_POST['e_contact'];
    $patient_relation = $_POST['patient_relation'];

    
    }   
    echo $fname;
    echo $lname;
    echo $email;
    echo $ph_num;
    echo $password;
    echo $DOB;
    echo $f_code;
    echo $e_contact;
    echo $patient_relation;

?>