<?php
    $incident_id = $_POST["incident_id"];
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
        mysqli_query($mysqli,"UPDATE `incidents` SET `incident_ended`=1, incident_date=incident_date WHERE `incident_id`=" . $incident_id . ";");
    }
echo mysqli_insert_id($mysqli);
header("LOCATION: ../command.php?dept=" . $department_id . "&incident=0");
?>