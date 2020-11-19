<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>HTML basics</title>
        <link href="../../assets/styles.css" rel="stylesheet" type="text/css">
        <script type="text/javascript" src="../../assets/check_patient.js" defer>
        </script>
    </head>
    <body class='main-body'>
      <section class='main-section'>
        <h1 class='main-header'>Please register here:</h1>

            <form class='main-form register-form' method="POST" action="../../src/auth/register.php">
              <label class='input-label' for="role">Please select your role first:</label>
                <select class='input' name="role" onchange="check_role(role)">
                  <option value="4">Caregiver</option>
                  <option value="3">Doctor</option>
                  <option value="2">Supervisor</option>
                  <option value="1">Administrator</option>
                  <option value="5">Patient</option>
                  <option value="6">Family Member</option>
                </select>
                <label class='input-label' for="f_name">First Name:</label>
                <input class='input' type="text" name="f_name">
                <label class='input-label' for="l_name">Last Name:</label>
                <input class='input' type="text" name="l_name">
                <label class='input-label' for="p_email">Email:</label>
                <input class='input' type="text" name="p_email">
                <label class='input-label' for="phone_number">Phone number:</label>
                <input class='input' type="tel" name="phone_number">
                <label class='input-label' for="password">Password:</label>
                <input class='input' type="password" name="password">
                <label class='input-label' for="DOB">Date of Birth:</label>
                <input class='input' type="Date" name="DOB">
                <label class='input-label' id ='f_code_label' for="f_code" style='display:none'>Family code:</label>
                <input class='input' id='f_code_input' type="text" name="f_code" style='display:none'>
                <label class='input-label' id='e_contact_label' for="e_contact" style='display:none'>Emergency contact:</label>
                <input class='input' id='e_contact_input' type="text" name="e_contact" style='display:none'>
                <label class='input-label' id='relation_label' for="relation" display='none' style='display:none'>Relation to emergency contact:</label>
                <input class='input' id='relation_input' type="text" name="relation" value="ex: Father" style='display:none'>
                <section class='register-buttons'>
                  <input class='submit' type="submit" name="register_submit" value="Submit">
                  <button class='submit' type="button" name="button" onclick="window.history.back();">Back</button>
                </section>

            </form>
      </section>

    </body>


</html>
