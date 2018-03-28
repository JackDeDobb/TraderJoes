<?php
include 'credentials.php';

session_start();




$user = $_GET["username"];
$pass = $_GET["password"];
$email = $_GET["email"];


//HERE INSERT CHECKS TO SEE IF THE USER ALREADY EXISTS FIRST




echo "Beginning to create user.\n";
$sql = "INSERT INTO User VALUES ('$user', '$name', '$pass')"; $conn->query($sql);
$sql = "INSERT INTO Profile VALUES ('$user', CURDATE(), '$age', '$gender', '$email')"; $conn->query($sql);
$sql = "INSERT INTO Game VALUES ('$user', CURRENT_TIMESTAMP)"; $conn->query($sql);
$sql = "INSERT INTO PlayerAssets VALUES ('$user', 5000)"; $conn->query($sql);

session_register("username");
$_SESSION['login_user'] = $user;

echo "Successfully created user.";





$conn->close();
?>
