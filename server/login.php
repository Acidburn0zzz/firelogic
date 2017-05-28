<?php
$user_username = $_POST["username"];
$user_password = $_POST["password"];

    $servername = "localhost";
    $username = "firelogic";
    $password = "firetruck";
    $dbname = "firelogic";


$mysqli = new mysqli($servername, $username, $password, $dbname);
if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}

if (!$mysqli->query("SET @p0='" . $user_username . "'") || !$mysqli->query("SET @p1='" . $user_password . "'") || !$mysqli->query("CALL `Login`(@p0, @p1, @p2, @p3, @p4, @p5, @p6)")) {
    echo "CALL failed: (" . $mysqli->errno . ") " . $mysqli->error;
}

if (!($res = $mysqli->query("SELECT @p2 AS `userid`, @p3 AS `out_hash`, @p4 AS `status`, @p5 AS `usertype`, @p6 AS `dept`"))) {
    echo "Fetch failed: (" . $mysqli->errno . ") " . $mysqli->error;
}

$row = $res->fetch_assoc();
if ($row["usertype"] == "Fire") {
    header("LOCATION: ../fire.html?dept=" . $row["dept"]);
}
if ($row["usertype"] == "EMS" || $row["usertype"] == "ALS" || $row["usertype"] == "BLS" || $row["usertype"] == "CERT") {
    header("LOCATION: ../ems.html?dept=" . $row["dept"]);
}
if ($row["usertype"] == "IC" || $row["usertype"] == "Chief" || $row["usertype"] == "Deptuty Chief") {
    header("LOCATION: ../command.php?dept=" . $row["dept"] . "&incident=0");
}
if ($row["usertype"] == "Admin") {
    header("LOCATION: ../admin.html?dept=" . $row["dept"]);
}
$returninfo = [];
$returninfo['userid'] = $row['userid'];
$returninfo['hash'] = $row['out_hash'];
$returninfo['status'] = $row['status'];
$returninfo['usertype'] = $row["usertype"];
echo json_encode($returninfo);

?>