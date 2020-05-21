<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Login</title>
  </head>
  <body>

  </body>
</html>
<?php
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

$UserID = $_POST["person_id"];
$Pass = $_POST["password_1"];
$UserType = $_POST["ocupant"];

$_SESSION['login_user']= $UserID;  // Initializing Session with value of PHP Variable


if ($UserType == 'gov')
{
    $sql = "SELECT * FROM GovTable WHERE ID=? and Pasw=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss",$UserID,$Pass);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    session_regenerate_id();
    $_SESSION['ID'] = $row['ID'];

    if ($result->num_rows==1)
    {
        header("location:gov.php");
    }
    else
    {
        header("location:loginfail.php");
    }
}
else if ($UserType == 'doc')
{
    $sql = "SELECT * FROM DocTable WHERE ID=? and Pasw=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss",$UserID,$Pass);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    session_regenerate_id();
    $_SESSION['ID'] = $row['ID'];

    if ($result->num_rows==1)
    {
        header("location:doc.html");
    }
    else
    {
        header("location:loginfail.php");
    }
}
else if ($UserType == 'labs')
{
    $sql = "SELECT * FROM labtable WHERE ID=? and Pasw=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss",$UserID,$Pass);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    session_regenerate_id();
    $_SESSION['ID'] = $row['ID'];

    if ($result->num_rows==1)
    {
        header("location:labs.html");
    }
    else
    {
        header("location:loginfail.php");
    }
}
else if ($UserType == 'pharm')
{
    $sql = "SELECT * FROM pharmtable WHERE ID=? and Pasw=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss",$UserID,$Pass);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    session_regenerate_id();
    $_SESSION['ID'] = $row['ID'];

    if ($result->num_rows==1)
    {
        header("location:pharm.html");
    }
    else
    {
        header("location:loginfail.php");
    }
}
else if ($UserType == 'patient')
{
    $sql = "SELECT * FROM PatientTable WHERE ID=? and Password=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss",$UserID,$Pass);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    session_regenerate_id();
    $_SESSION['ID'] = $row['ID'];

    if ($result->num_rows==1)
    {
        header("location:patient.php");
    }
    else
    {
        header("location:loginfail.php");
    }
}

$conn->close();
?>