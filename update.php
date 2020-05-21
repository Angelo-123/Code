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

$ID = $_POST["id"];


    $sql = "SELECT * FROM medicaltable WHERE Patient_ID='$ID' AND ICD_10_code=''";
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
</html>