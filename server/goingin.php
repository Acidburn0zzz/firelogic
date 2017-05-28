<?php
    $user_id = $_POST["user_id"];
    $incident_id = $_POST["incident_id"];
    $servername = "localhost";
    $username = "firelogic";
    $password = "firetruck";
    $dbname = "firelogic";

    $mysqli = new mysqli($servername, $username, $password, $dbname);
    if ($mysqli->connect_errno) {
        echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
    }
    else {
        mysqli_query($mysqli,"INSERT INTO `activetime` (`incident_id`, `user_id`, `time_in`, `time_out`) VALUES ('" . $incident_id . "', '" . $user_id . "', CURRENT_TIMESTAMP, NULL);");
    }
echo mysqli_insert_id($mysqli);;
?>