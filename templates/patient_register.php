<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>HTML basics</title>
    </head>
    <body>
        <h1>Register your family member's information here</h1>

            <form method="POST" action="../src/auth/register.php">
              <label for="role">Please select your role first:</label>
                <select name="role" onchange="check_role(role)">
                  <option value="caregiver">Caregiver</option>
                  <option value="doctor">Doctor</option>
                  <option value="supervisor">Supervisor</option>
                  <option value="administrator">Administrator</option>
                  <option value="patient">Patient</option>
                  <option value="family_member">Family Member</option>
                </select>
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
                <label id ='f_code_label' for="f_code" style='display:none'>Family code:</label>
                <input id='f_code_input' type="text" name="f_code" style='display:none'>
                <label id='e_contact_label' for="e_contact" style='display:none'>Emergency contact:</label>
                <input id='e_contact_input' type="text" name="e_contact" style='display:none'>
                <label id='relation_label' for="relation" display='none' style='display:none'>Relation to emergency contact:</label>
                <input id='relation_input' type="text" name="relation" value="ex: Father" style='display:none'>


                <input type="submit" name="register_submit" value="Submit Patient Form">
            </form>

    </body>

<script type="text/javascript" src="../src/auth/check_patient.js">

</script>
</html>
