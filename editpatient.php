<?php
echo "Welcome Patient";

session_start();

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

$UserID = $_SESSION['login_user'];
$Pass = $_POST["password_1"];
$Adr = $_POST["Address"];
$Nr = $_POST["Nr"];
$Email = $_POST["emailAdd"];

echo $UserID, $Pass, $Adr, $Nr, $Email;
echo "<br><br><H1>This does not work</H1>";
//$sql = "UPDATE patienttable SET Password='$Pass', Address='$Adr', Contact_details_1='$Nr', Contact_details_2='$Email' WHERE ID='$UserID'";
$sql = "UPDATE patienttable SET Password='$Pass' WHERE ID='$UserID'";

    if ($conn->query($sql) === TRUE) {
        echo "Record updated successfully";
    } else {
        echo "Error updating record: " . $conn->error;
    }

    //header("location:patient.php");

    $conn->close();
?>