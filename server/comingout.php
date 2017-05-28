<?php
    $id = $_POST["id"];
    $servername = "localhost";
    $username = "firelogic";
    $password = "firetruck";
    $dbname = "firelogic";

    $mysqli = new mysqli($servername, $username, $password, $dbname);
    if ($mysqli->connect_errno) {
        echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
    }
    else {
        mysqli_query($mysqli,"UPDATE `activetime` SET `time_out`=CURRENT_TIMESTAMP, `time_out`=`time_out` WHERE `id`=" . $id . ";");
    }
echo mysqli_insert_id($mysqli);;
?>