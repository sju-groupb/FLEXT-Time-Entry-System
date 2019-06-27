
<?PHP
session_start();

//Ryan Granahan
// Opens a connection to the database
// Since it is a php file it won't open in a browser
// It should be saved outside of the main web documents folder
// and imported when needed
include 'mysqli_connect.php';


//  Back button in case user needs to go back to main login screen
// echo "<a class='btn btn-primary' href='http://192.168.64.2/TimeFlexSystem_WebApp/user_page.html' style='height:60px; width:100px; font-size:22pt; margin-bottom:-150px; margin-top:5px; margin-left:5px;'>Back</a>";


// Receive Employee ID # from previous page
$id = $_SESSION['userPIN'];
// Use Employee ID from previous page to find name of Employee in database


$sql = "SELECT * FROM Employee WHERE Employee.Emp_PIN =" . $id . " LIMIT 1";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
do {
	$employee = $row["Emp_PIN"];
} while ($row = $result->fetch_assoc());
echo "<h1 align='center' style='font-size:60pt;'>" . $employee . "</h1>";
$name = $employee;
if (($name == NULL) || ($name == "")) {
    echo "no name found";
	//header('Location: http://192.168.64.2/TimeFlexSystem_WebApp/');
}
// Get current time & date
$time = date("Y-m-d H:i:s");
$date = date("Y-m-d");
// Get day of week, to prepend to variable for searching in database
$DayOfWeek = date("D");
$DayOfWeek = strtoupper($DayOfWeek);
// Select records from last 7 days
$Days = 7;
$sql = "SELECT * 
FROM TimeEntry, Employee 
WHERE DATE(TimeEntry.date_sub) > ( NOW() - INTERVAL " . $Days . " DAY) AND Employee.Emp_Name=" . $name . " 
ORDER BY Employee.Emp_Name
 ASC LIMIT 1;";

$result = $conn->query($sql);
$row = $result->fetch_assoc();
$x = 0;
do {
	$x++;
	$DayIN = $row[$DayOfWeek . "-IN"];
	$DayOUT = $row[$DayOfWeek . "-OUT"];
	$NameOnRecord = $row[$name];
} while ($row = $result->fetch_assoc());
// If the employee does not have a record for the current week, create a blank record for employee.
if (($x == 1) && (!$NameOnRecord)) {
	$sql = "INSERT INTO timeflexsystem.TimeEntry (,) VALUES ('" . $time . "','" . $name . "')";
	mysqli_query($conn,$sql) or die(mysqli_error($conn));
	echo "<script>location.(true);</script>";
}
$conn->close();
?>

<html>
<title>Employee Time Clock</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />

<link rel="stylesheet" href="../css/bootstrap.min.css">
<script src="../js/jquery.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
<head></head>
<body onload="startTime()">
	<div class="container-fluid">
		<form class="form-horizontal"  action="submit-time.php" method="post">
			<fieldset>

			<div align="center">
	   		<div align="center">

				<!-- Check if employee has already recorded any times for today, if so, don't show button. -->
				<?php if ($DayIN == "0000-00-00 00:00:00") {
					echo "<button id='TimeIN-btn' style='width:200px; height:200px; margin:20px; font-size:30pt;' name='TimeIN-btn' class='btn btn-success' value='-IN'>Time<br />IN</button>";
				} ?>
				<?php if ($DayOUT == "0000-00-00 00:00:00") {
					echo "<button id='TimeOUT-btn' style='width:200px; height:200px; margin:20px; font-size:30pt;' name='TimeOUT-btn' class='btn btn-danger' value='-OUT'>Time<br />OUT</button>";
				} ?>
				<?php if (((($DayIN != "0000-00-00 00:00:00")  && ($DayOUT != "0000-00-00 00:00:00")))) {
					echo "<h1 align='center' style='font-size:30pt;'>Your Time Card is full for today.<br />Enjoy the rest of your day!</h1>";
				} ?>

	  			</div>
			</div>

			<?php
			// Pass name variable to be written to database on next page
			echo "<input type='hidden' name='name' value='" . $name . "'>";
			?>

			</fieldset>
		</form>
	</div>

	<div id="txt" align="center" style="font-size:50pt;"></div>

	<script> // Show current time
		function startTime() {
    			var today = new Date();
    			var h = today.getHours();
    			var m = today.getMinutes();
    			var s = today.getSeconds();
    			m = checkTime(m);
    			s = checkTime(s);
    			document.getElementById('txt').innerHTML =
    			h + ":" + m + ":" + s;
    			var t = setTimeout(startTime, 500);
		}
		function checkTime(i) {
    			if (i < 10) {i = "0" + i};  // add zero in front of numbers < 10
    			return i;
		}
	</script>

	<?php
// Add flair to employee's punch-in screen.
if ($name == "Employee Name") {
	echo "<style> h1 { color:blue; } </style>";
	echo "<img style='margin-top:-120px;' height='30%' src='../images/animated.gif' align='left' />";
	echo "<img style='margin-top:-120px; margin-right:-230px; float:right;' height='30%' src='../images/animated.gif' align='left' />";
}
?>

</body>

</html>