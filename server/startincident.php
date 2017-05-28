<?php
    $department_id = $_POST["department_id"];

    $servername = "localhost";
    $username = "firelogic";
    $password = "firetruck";
    $dbname = "firelogic";

    $mysqli = new mysqli($servername, $username, $password, $dbname);
    if ($mysqli->connect_errno) {
        echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
    }
    else {
        mysqli_query($mysqli,"INSERT INTO `incidents` (`incident_id`, `incident_date`, `department_id`, `incident_ended`) VALUES (NULL, CURRENT_TIMESTAMP, '" . $department_id . "', '0');");
    }
echo mysqli_insert_id($mysqli);
    header("LOCATION: ../command.php?dept=" . $department_id . "&incident=" . mysqli_insert_id($mysqli));
?>