<!DOCTYPE html>
<html lang="en" dir="ltr">
<style>
        * {
    margin: 0px;
    padding: 0px;
}
body {
    font-size: 120%;
    background: #F8F8FF;
}

.header {
    width: 30%;
    margin: 50px auto 0px;
    color: white;
    background: #5F9EA0;
    text-align: center;
    border: 1px solid #B0C4DE;
    border-bottom: none;
    border-radius: 10px 10px 0px 0px;
    padding: 20px;
}
form {
    width: 30%;
    margin: 0px auto;
    padding: 20px;
    border: 1px solid #B0C4DE;
    background: white;
    border-radius: 0px 0px 10px 10px;
}
.input-group {
    margin: 10px 0px 10px 0px;
}
.input-group label {
    display: block;
    text-align: left;
    margin: 3px;
}
.input-group input {
    height: 30px;
    width: 93%;
    padding: 5px 10px;
    font-size: 16px;
    border-radius: 5px;
    border: 1px solid gray;
}
.btn {
    padding: 10px;
    font-size: 15px;
    color: white;
    background: #5F9EA0;
    border: none;
    border-radius: 5px;
}
    </style>
  <head>
    <meta charset="utf-8">
    <title>Pharm</title>
  </head>
  <body>
    <a href="pharm.html">Home Page</a>
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
$Choise = $_POST["choise"];

if ($Choise == 'readmed')
{
    echo "Patients medical history:";
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
}
else if ($Choise == 'readap')
{
    echo "Patients medical aid info:";
    $sql = "SELECT * FROM medicalaidtable WHERE ID='$ID'";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
	    echo "<table><tr><th>Medical</th><th>Membership_no</th><th>Medical_plan</th></tr>";
        // output data of each row
        while($row = $result->fetch_assoc()) {
            echo "<tr><td>".$row["Medical"]."</td><td>".$row["Membership_no"]."</td><td>".$row["Medical_plan"]."</td></tr>";
	    }
	    echo "</table>";
    } else {
        echo "0 results";
    }
    //$conn->close();

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
}/*
else if ($Choise == 'writep')
{
    header("location:writep.html");
}
*/
?>

<html>
    <head>
    <meta charset="utf-8">
    <title>Pharm</title>
  </head>
  <body>
    <div class="header">
            <h2>Complete Prescription</h2>
        </div>
    <form method="post" action="writep.php">
        <div class="input-group">
            <label>Patient ID: </label>
            <input type="number" name="person_id" placeholder="" maxlength="15" minlength="15" required>
        </div>
        <div class="input-group">
            <label>Prescription ID: </label>
            <input type="number" name="prescrID"  placeholder="" maxlength="6" >
        </div>
            <div class="input-group">
                <label>Prescription: </label>
                <input type="text" name="prescr"  placeholder="" maxlength="20" >
            </div>
            <div class="input-group">
                <button type="submit" name="add" class="btn">Submit</button>
            </div>
    </form>

  </body>
</html>