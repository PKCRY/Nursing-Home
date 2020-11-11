<?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = $_POST['username'];
        if (empty($username)) {
            echo "Please put in your username";
        } else {
            echo "your username is: ";
            echo $username;
        }
    }
    ?>