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


$sql = "SELECT 1 FROM table WHERE key = $user;";
if ($conn->query($sql) === 0) {
    echo "Beginning to Create User\n";
} else {
    echo "User already exists";
    return;
}





?>
