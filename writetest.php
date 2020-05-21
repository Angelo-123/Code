<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Pharm</title>
  </head>
  <body>
    <a href="pharm.html">Home Page</a><br><br>
  </body>
</html>

<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "projek";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$ID = $_POST["person_id"];
$Test = $_POST["test"];
$TestR = $_POST["result"];

$sql = "UPDATE medicaltable SET Lab_results='$TestR' WHERE Patient_ID='$ID' AND Lab_tests='$Test' AND Lab_results IS NULL";

    if ($conn->query($sql) === TRUE) {
        echo "Record updated successfully";
    } else {
        echo "Error updating record: " . $conn->error;
    }

    $conn->close();
?>