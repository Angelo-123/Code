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

// prepare and bind
$stmt = $conn->prepare("INSERT INTO medicaltable (Patient_ID, Consultation_date, Physician, Practice_no, Symptoms, Lab_tests, ICD_10_code) VALUES (?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("ississs", $ID, $Date, $Phys, $PracNr, $Symp, $Labtest, $idccode);

// set parameters and execute
$ID = $_POST["person_id"];
$Date = date("Y-m-d");
$Phys = $_POST["phys"];
$PracNr = $_POST["pracnr"];
$Symp = $_POST["symp"];
$Labtest = $_POST["labtest"];
$idccode = $_POST["idccode"];
$stmt->execute();

echo "New medical record created successfully.";
echo $_POST["prescrID"];

    if ($idccode != ''){
    // prepare and bind
    $stmt = $conn->prepare("INSERT INTO prescriptiontable (Patient_ID, Consultation_date, Prescription_ID, Prescription, No_repetitions) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("isisi", $ID, $Date, $PrescrID, $prescr, $prescrNr);

    // set parameters and execute
    $ID = $_POST["person_id"];
    $Date = date("Y-m-d");
    $PrescrID = $_POST["prescrID"];
    $prescr = $_POST["prescr"];
    $prescrNr = $_POST["prescrNr"];
    $stmt->execute();

    echo "New Prescription record created successfully.";
}

    $sql = "SELECT * FROM medicaltable WHERE Patient_ID='$ID' ORDER BY Consultation_date";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
	    echo "<table><tr><th>Consultation_date</th><th>Physician</th><th>Practice_no</th><th>Symptoms</th><th>Lab_tests</th><th>Lab_results</th><th>ICD_10_code</th></tr>";
        // output data of each row
        while($row = $result->fetch_assoc()) {
            echo "<tr><td>".$row["Consultation_date"]."</td><td>".$row["Physician"]."</td><td>".$row["Practice_no"]."</td><td>".$row["Symptoms"]."</td><td>".$row["Lab_tests"]."</td><td>".$row["Lab_results"]."</td><td>".$row["ICD_10_code"]."</td></tr>";
	    }
	    echo "</table>";
    } else {
        echo "0 results";
    }
    $conn->close();

?>