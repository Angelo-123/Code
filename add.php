<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Add</title>
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


//echo $_POST["person_id"], $_POST["password_1"], $_POST["surname"], $_POST["name"], $_POST["bday"], $_POST["gender"], $_POST["Address"], $_POST["Nr"], $_POST["emailAdd"];

// prepare and bind
$stmt = $conn->prepare("INSERT INTO patienttable (ID, Password, Surname, First_names, Date_of_birth, Gender, Address, Contact_details_1, Contact_details_2) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("issssssis", $ID, $Pass, $Surname, $name, $BirthDate, $Gender, $Address, $Nr, $Email);

// set parameters and execute
$ID = $_POST["person_id"];
$Pass = $_POST["password_1"];
$Surname = $_POST["surname"];
$name = $_POST["name"];
$BirthDate = $_POST["bday"];
$Gender = $_POST["gender"];
$Address = $_POST["Address"];
$Nr = $_POST["Nr"];
$Email = $_POST["emailAdd"];
$stmt->execute();

echo "New record created successfully.";

$sql = "SELECT * FROM patienttable Where ID='$ID'";
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
exit();
?>