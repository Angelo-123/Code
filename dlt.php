<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Delete</title>
  </head>
  <body>
    <a href="gov.php">Main Page</a>
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

$ID = $_POST["id"];
$Surame=$_POST["surname"];
$sql = "DELETE FROM patienttable WHERE ID='$ID' AND Surname='$Surame'";

if ($conn->query($sql) === TRUE) {
    echo "Record deleted successfully";
} else {
    echo "Error deleting record: " . $conn->error;
}

$sql = "SELECT * FROM patienttable";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
	echo "<table><tr><th>ID</th><th>Surname</th><th>First name(s)</th><th>Date of Birth</th><th>Gender</th></tr>";
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<tr><td>".$row["ID"]."</td><td>".$row["Surname"]."</td><td>".$row["First_names"]."</td><td>".$row["Date_of_birth"]."</td><td>".$row["Gender"]."</td></tr>";
	}
	echo "</table>";
} else {
    echo "0 results";
}
$conn->close();
?>