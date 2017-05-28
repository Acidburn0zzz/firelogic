<?php
    $department_name = $_POST["department_name"];
    $department_password = $_POST["department_password"];

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

    $hashsalt = md5($department_password . $salt);

    $servername = "localhost";
    $username = "firelogic";
    $password = "firetruck";
    $dbname = "firelogic";

    $mysqli = new mysqli($servername, $username, $password, $dbname);
    if ($mysqli->connect_errno) {
        echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
    }
    else {
        mysqli_query($mysqli,"INSERT INTO `departments` (`department_id`, `department_name`, `department_hash`, `department_salt`) VALUES (NULL, '" . $department_name . "', '" . $hashsalt . "', '" . $salt . "');");
    }

    $department_id = mysqli_insert_id($mysqli);
    $user_name = $department_name;
    $servername = "localhost";
    $username = "firelogic";
    $password = "firetruck";
    $dbname = "firelogic";

    $mysqli = new mysqli($servername, $username, $password, $dbname);
    if ($mysqli->connect_errno) {
        echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
    }
    else {
        mysqli_query($mysqli,"INSERT INTO `users` (`user_id`, `user_name`, `department_id`, `user_hash`, `user_salt`, `user_type`) VALUES (NULL, '" . $department_name . "', '" . $department_id . "', '" . $hashsalt . "', '" . $salt . "', 'Admin');");
    }
header("LOCATION: ../");
?>