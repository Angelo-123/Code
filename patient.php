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

echo "Your medical aid info:";
    $sql = "SELECT * FROM medicalaidtable WHERE ID='$UserID'";
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
    echo "<br><br>";
    echo "Your Medical History:";
    $sql = "SELECT * FROM medicaltable WHERE Patient_ID='$UserID' ORDER BY Consultation_date";
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

    echo "<br><br>";
    echo "Your medical prescription info:";
    $newsql = "SELECT * FROM prescriptiontable WHERE Patient_ID='$UserID' ORDER BY Consultation_date";
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


    echo "<br><br>";
    echo "Your Biographic info:";
    $sql = "SELECT * FROM patienttable WHERE ID='$UserID'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
	    echo "<table><tr><th>ID</th><th>Surname</th><th>First names</th><th>Date of Birth</th><th>Gender</th><th>Address</th><th>Contact_details_1</th><th>Contact_details_2</th></tr>";
      // output data of each row
      while($row = $result->fetch_assoc()) {
        echo "<tr><td>".$row["ID"]."</td><td>".$row["Surname"]."</td><td>".$row["First_names"]."</td><td>".$row["Date_of_birth"]."</td><td>".$row["Gender"]."</td><td>".$row["Address"]."</td><td>".$row["Contact_details_1"]."</td><td>".$row["Contact_details_2"]."</td></tr>";
	    }
	    echo "</table>";
    } else {
      echo "0 results";
    }

$conn->close();
?>

<html>
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
  <body>
  <div class="header">
            <h2>Edit Personal Info</h2>
        </div>
    <form method="post" action="editpatient.php">
    <div class="input-group">
            <label>Password: </label>
            <!--<input type="password" name="password_1" placeholder="" required>-->
            <input type="text" name="password_1"  placeholder="" maxlength="60">
        </div>
            <div class="input-group">
                <label>Address: </label>
                <input type="text" name="Address"  placeholder="" maxlength="60" required>
            </div>
            <div class="input-group">
                <label>Phone Number: </label>
                <!--<input type="tel" name="Nr" pattern="[0-9]{10}" placeholder="">-->
                <input type="text" name="Nr"  placeholder="" maxlength="60">
            </div>
            <div class="input-group">
                <label>Email Address: </label>
                <input type="text" name="emailAdd"  placeholder="" maxlength="60">
            </div>
            <div class="input-group">
                <button type="submit" name="edit" class="btn">Edit</button>
            </div>
    </form>

  </body>
</html>