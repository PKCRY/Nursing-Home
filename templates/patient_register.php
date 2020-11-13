
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>HTML basics</title>
    </head>
    <body>
        <h1>Register your family member's information here</h1>

            <form action='patient_register.php'>
              <label for="role">Please select your role first:</label>
              <select name="role" onchange="this.form.submit()">
                <option value="patient">Patient</option>
                <option value="family_member">Family Member</option>
                <option value="caregiver">Caregiver</option>
                <option value="doctor">Doctor</option>
                <option value="supervisor">Supervisor</option>
                <option value="administrator">Administrator</option>
              </select>
            </form>


            <form method="POST" action="../src/auth/register.php">
                <label for="f_name">First Name:</label>
                <input type="text" name="f_name">
                <label for="l_name">Last Name:</label>
                <input type="text" name="l_name">
                <label for="p_email">Email:</label>
                <input type="text" name="p_email">
                <label for="phone_number">Phone number:</label>
                <input type="tel" name="phone_number">
                <label for="password">Password:</label>
                <input type="password" name="password">
                <label for="DOB">Date of Birth:</label>
                <input type="Date" name="DOB">

                <?php
                if (isset($_POST['role'])) {
                  if ($_POST['role'] = 'patient') {
                    echo <<<EOL
                    <label for="f_code">Family code:</label>
                    <input type="text" name="f_code">
                    <label for="e_contact">Emergency contact:</label>
                    <input type="text" name="e_contact">
                    <label for="patient_relation">Relation to contact:</label>
                    <input type="text" name="patient_relation">
                    EOL;
                  }
                }
                ?>


                <input type="submit" name="register_submit" value="Submit Patient Form">
            </form>

    </body>


</html>
