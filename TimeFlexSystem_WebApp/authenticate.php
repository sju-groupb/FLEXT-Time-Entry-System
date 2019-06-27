<?php

include 'mysqli_connect.php';
session_start();
$_SESSION['EmployeeID'] = $_POST['EmployeeID'];

$userInput = $_POST['EmployeeID'];
$sql = "SELECT * from Employees where EmployeeID = '$userInput'";
$result = $conn->query($sql);
if ($result) {
    if ($result->num_rows > 0) {
        header('Location:http://192.168.64.2/TimeFlexSystem_WebApp/user_page.html ');
    } else {
        echo "<p > WRONG </p>";
        header('Location: http://192.168.64.2/TimeFlexSystem_WebApp/login_page.html');
    }
} else {
    echo "NONE";
}
$conn->close();