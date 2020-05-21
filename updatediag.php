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
    <title>Doc</title>
  </head>
  <body>
    <a href="doc.html">Home Page</a>
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
$Labtest = $_POST["labtest"];
$idccode = $_POST["idccode"];

$sql = "UPDATE medicaltable SET ICD_10_code='$idccode' WHERE Patient_ID='$ID' AND Lab_tests='$Labtest' AND ICD_10_code=''";

    if ($conn->query($sql) === TRUE) {
        echo "Record updated successfully";
    } else {
        echo "Error updating record: " . $conn->error;
    }

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


    $conn->close();
  
?>
<!--
<html>
  <body>
  <div class="header">
            <h2>Add Diagnosis</h2>
        </div>
    <form method="post" action="updatediag.php">
        <div class="input-group">
            <label>ID: </label>
            <input type="number" name="person_id" placeholder="" maxlength="15" minlength="15" required>
        </div>
            <div class="input-group">
                <label>Lab tests: </label>
                <input type="text" name="labtest" placeholder="">
            </div>
            <div class="input-group">
                <label>ICD-10_code: </label>
                <input type="text" name="idccode" placeholder="">
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
                <label>Number of repetitions: </label>
                <input type="number" name="prescrNr" placeholder="">
            </div>
            <div class="input-group">
                <button type="submit" name="add" class="btn">Add</button>
            </div>
    </form>

  </body>
</html>-->