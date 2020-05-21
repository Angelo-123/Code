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
$PrescrID = $_POST["prescrID"];
$Prescr = $_POST["prescr"];

$sql = "SELECT * FROM prescriptiontable where Patient_ID='$ID' && Prescription_ID='$PrescrID' && Prescription='$Prescr'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {

    if($row = $result->fetch_assoc()) {
        $oldNo = $row["No_repetitions"];
        $newdate = date("Y-m-d");
        if ($oldNo!=0)
        {
            $sql = "UPDATE prescriptiontable SET No_repetitions=No_repetitions-1, Collection_date='$newdate'  WHERE Patient_ID='$ID' && Prescription_ID='$PrescrID' && Prescription='$Prescr'";

            if ($conn->query($sql) === TRUE) {
                echo "Record updated successfully";
            } else {
                echo "Error updating record: " . $conn->error;
            }
        }
        else
        {
            echo "<H1>Prescription not valid.</H1>";
        }
    }

} else {
    echo "0 results";
}

echo "<br><br>";
    echo "Patients medical prescription info:";
    $newsql = "SELECT * FROM prescriptiontable WHERE Patient_ID='$ID' ORDER BY Consultation_date";
    $newresult = $conn->query($newsql);
    
    if ($newresult->num_rows > 0) {
	    echo "<table><tr><th>Consultation_date</th><th>Prescription_ID</th><th>Prescription</th><th>No_repetitions</th><th>Collection_date</th></tr>";
        // output data of each row
        while($row = $newresult->fetch_assoc()) {
            echo "<tr><td>".$row["Consultation_date"]."</td><td>".$row["Prescription_ID"]."</td><td>".$row["Prescription"]."</td><td>".$row["No_repetitions"]."</td><td>".$row["Collection_date"]."</td></tr>";
	    }
	    echo "</table>";
    } else {
        echo "0 results";
    }
    $conn->close();
?>