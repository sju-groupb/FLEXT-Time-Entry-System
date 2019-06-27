
<script> window.print(); </script>
<?php
// Ryan Granahan
// weekly-time-clock.php
// Database Info
echo "<a class='btn btn-primary' href='user_page.html' style='height:60px; background: rgb(246,185,145); width:100px; font-size:22pt;
 margin-bottom:-150px; margin-top:5px; margin-left:5px;'>Back</a>";

require_once ('mysqli_connect.php');
// Create connection
$conn = new mysqli($host, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$sql = "SELECT Employees.Name,Employees.email,Employees.phone  FROM Employees  ORDER BY Name ASC";
$result = $conn->query($sql);
echo "<h1 align='center'>Employee Records </h1>\n";
if ($result->num_rows > 0) {
    // output data of each row
    //	do {
    while ($row = $result->fetch_assoc()) {
        $name = $row["Name"];
        $email = $row["email"];
        $phone = $row["phone"];
        //$i = 0;
       // if ($i == 0) {
            //echo "<h1 align='center'>Employee Records </h1>\n";
            // Create Table
            echo "<table class='pure-table pure-table-bordered' border='1' align='center' width='500px' style='border: 1px solid black; border-collapse: collapse;'>";
            echo "<tr>";
            echo "<th width='500px' align='center' style='border: 1px solid black;'>" . "&nbsp;Name&nbsp;" . "</th>";
            echo "<th width='500px' align='center' style='border: 1px solid black;'>" . "&nbsp;email&nbsp;" . "</th>";
            echo "<th width='800px' align='center' style='border: 1px solid black;'>" . "&nbsp;phone&nbsp;" . "</th>";

            echo "</tr>";
            echo "<tr>";
            echo "<td align='center'>" . $name . "</td>";
            echo "<td align='center'>" . $email . "</td>";
            echo "<td align='center'>" . $phone . "</td>";

            echo "</tr>";




        }
   // }
} else {
    echo "0 results";
}
$conn->close();
?>

<html>
<title></title>
<head>
    <link rel="stylesheet" href="https://unpkg.com/purecss@1.0.0/build/pure-min.css" integrity="sha384-nn4HPE8lTHyVtfCBi5yW9d20FjT8BJwUXyWZT9InLYax14RDjBj46LmSztkmNP9w" crossorigin="anonymous">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style type="text/css" media="print">
        @page { size: landscape; }
    </style>
</head>
<body>

</body>
</html><?php



