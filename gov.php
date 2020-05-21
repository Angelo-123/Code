<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Gov</title>
  </head>
  <body>
    <a href="add.html">Add Person</a> -
	<a href="dlt.html">Remove Person</a><br>
  </body>
</html>

<?php
echo "logged in";

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

$sql = "SELECT * FROM patienttable";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
	echo "<table><tr><th>ID</th><th>Surname</th><th>First names</th><th>Date of Birth</th><th>Gender</th></tr>";
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