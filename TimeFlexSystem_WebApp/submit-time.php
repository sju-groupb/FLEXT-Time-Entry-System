<?php
// Ryan Granahan
// submit-time.php
// Check if already clocked for specific request


$TimeIN = null;
$TimeOUT = null;
$LunchIN = null;
$LunchOUT = null;
$name = null;

if(isset($_POST['name'])){
    $name = $_POST['name'];
}
// Read which button user pressed
//$TimeIN = $_POST['TimeIN-btn'];
if(isset($_POST['TimeIN-btn'])){
    $TimeIN = $_POST['TimeIN-btn'];
}
// $TimeOUT = $_POST['TimeOUT-btn'];
if(isset($_POST['TimeOUT-btn'])){
    $TimeOUT = $_POST['TimeOUT-btn'];
}
//$LunchIN = $_POST['LunchIN-btn'];
if(isset($_POST['LunchIN-btn'])){
    $LunchIN = $_POST['LunchIN-btn'];
}
//$LunchOUT = $_POST['LunchOUT-btn'];
if(isset($_POST['LunchOUT-btn'])){
    $LunchOUT = $_POST['LunchOUT-btn'];
}
// Append string value from button user pressed
$mode = $TimeIN . $TimeOUT . $LunchIN . $LunchOUT;
$time = date("Y-m-d H:i:s");
$date = date("Y-m-d");
$DayOfWeek = date("D");
$DayOfWeek = strtoupper($DayOfWeek);
$column = $DayOfWeek . $mode;
// Database Info
require_once ('mysqli_connect.php');
// Create connection
$conn = new mysqli($host, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$sql = "SELECT `" . $column . "` FROM TimeClock WHERE Date='" . $date . "' AND Name='" . $name . "' ORDER BY Date ASC LIMIT 1";
$result = $conn->query($sql) or die($conn->error);
$row = $result->fetch_assoc();


do {
    $field = $row[$column];
} while ($row = $result->fetch_assoc());
// Write to timeclock
$Days = 7;
$sql = "UPDATE timeflexsystem.TimeClock SET `" . $column . "`='" . $time . "' WHERE Date > DATE_SUB( NOW(), INTERVAL " . $Days . " DAY) AND Name='" . $name . "'";
mysqli_query($conn,$sql) or die(mysqli_error($conn));
?>

    <html>
    <title></title>
    <head></head>
    <body>
    <br /><br />
    <script>window.location.href = "index.php";</script>
    </body>
    </html><?php
