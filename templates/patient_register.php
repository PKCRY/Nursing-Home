<!DOCTYPE html>
<html>
    <head>  
        <meta charset="utf-8">
        <title>HTML basics</title>
    </head>
    <body>
        <h1>Register your family member's information here</h1>
            <form method="POST" action="<?php echo $_SERVER['PHP_SELF'];?>">
                <p>First Name</p>
                <input type="text" name="f_name">
                <p>Last Name</p>
                <input type="text" name="l_name">
                <p>Email</p>
                <input type="text" name="p_email">
                <p>Phone Number</p>
                <input type="tel" name="phone_number">
                <p>Password</p>
                <input type="password" name="password">
                <p>Date of Birth</p>
                <input type="Date" name="DOB">
                <p>Family Code</p>
                <input type="text" name="f_code">
                <p>Emergency Contact</p>
                <input type="text" name="e_contact">
                <p>Relation to Patient</p>
                <input type="text" name="patient_relation">
                
                <input type="submit" name="register_submit" value="Submit Patient Form">
            </form>

            <?php 
                require '../src/register.php';
            ?>

    </body>


</html>