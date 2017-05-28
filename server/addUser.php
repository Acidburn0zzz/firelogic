<?php
    $department_id = $_POST["department_id"];
    $user_name = $_POST["user_name"];
    $user_password = $_POST["user_password"];
    $user_type = $_POST["user_type"];
    function generateRandomString($length = 50) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    $salt = generateRandomString();

    $hashsalt = md5($user_password . $salt);

    $servername = "localhost";
    $username = "firelogic";
    $password = "firetruck";
    $dbname = "firelogic";

    $mysqli = new mysqli($servername, $username, $password, $dbname);
    if ($mysqli->connect_errno) {
        echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
    }
    else {
        mysqli_query($mysqli,"INSERT INTO `users` (`user_id`, `user_name`, `department_id`, `user_hash`, `user_salt`, `user_type`) VALUES (NULL, '" . $user_name . "', '" . $department_id . "', '" . $hashsalt . "', '" . $salt . "', '" . $user_type . "');");
    }
header("LOCATION: ../admin.html?dept=" . $department_id . "");
?>