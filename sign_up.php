<?php
include 'credentials.php';

session_start();




$user = $_GET["username"];
$pass = $_GET["password"];
$email = $_GET["email"];


//HERE INSERT CHECKS
//Throw an error if password is too short
if(strlen($pass) < 8) { echo "Error: Password must be at least 8 characters!"; return; }

//Throw an error if email is not valid
if(!($email contains '@')) { echo "Error: Email " . $email . " is not a valid email!"; return;}

//Throw an error if that username already exists
$sql = "SELECT username FROM User WHERE username = '$user'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
if($row == true){ echo "Error: User " . $user . " already exists!"; return; }



echo "Beginning to create user.\n";
$sql = "INSERT INTO User VALUES ('$user', '$name', '$pass')"; $conn->query($sql);
$sql = "INSERT INTO Profile VALUES ('$user', CURDATE(), '$age', '$gender', '$email')"; $conn->query($sql);
$sql = "INSERT INTO Game VALUES ('$user', CURRENT_TIMESTAMP)"; $conn->query($sql);
$sql = "INSERT INTO PlayerAssets VALUES ('$user', 5000)"; $conn->query($sql);

//session_register("user");
$_SESSION['login_user'] = $user;

echo "Successfully created user.";




$conn->close();
?>
