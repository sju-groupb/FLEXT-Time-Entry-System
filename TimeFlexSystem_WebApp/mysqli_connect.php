
<?php
// Opens a connection to the database
// Since it is a php file it won't open in a browser 
// It should be saved outside of the main web documents folder
// and imported when needed


$host = "timeflexsystem.cjjaiocspkz6.us-east-1.rds.amazonaws.com";
$username = "timeflexsystem";
$password = "timeflexsystem";
$dbname = "timeflexsystem";
$conn = new mysqli($host, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} else {
    //echo "Connected successfully";
}



// $userInput = $_POST["PIN"];
$sql = "SELECT * from Employee where Emp_PIN = 1234";
$result = $conn->query($sql);
if ($result) {

    if ($result->num_rows > 0) {
        echo "CREDENTIALS ARE CORRECT";
    } else {
        echo "<p > WRONG </p>";
    }
} else {
    echo "NONE";
}

$conn->close();


?>