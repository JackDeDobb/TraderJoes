<?php
include 'credentials.php';

session_start();

$user = $_GET["username"];
$pass = $_GET["password"];

//Throw an error if the username exists
$sql = "SELECT * FROM User WHERE username = '$user'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
if($row == false){ echo "Error: User " . $user . " does not exist!"; return; }

//Throw an error if the password does not match password in database
if (strcmp($row["password"], $pass) != 0) { echo "Error: Password does not match!"; return; };


?>
