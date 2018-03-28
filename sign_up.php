<?php
include 'credentials.php';

$user = $_GET["username"];
$pass = $_GET["password"];
$email = $_GET["email"];

print $user;
print $pass;
print $email;

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$sql = "SELECT count(1) FROM Profile WHERE Profile.username = $user;";
if ($conn->query($sql) == 1) {
    echo "User already exists";
    return;
}

echo "Beginning to create user.";




$conn->close();
?>
