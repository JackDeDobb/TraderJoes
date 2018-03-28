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


// $sql = "SELECT username FROM Profile WHERE Profile.username = '$user';";
// $result = $conn->query($sql);
// echo(mysql_fetch_object($result));


$sql = "INSERT INTO User(username, name, password) VALUES ('yes', 'ok', 'no')";
$conn->query($sql);

$result = $conn->query($sql = "SELECT username FROM User(username, name, password) WHERE username = '$user';");

if ($result->num_rows > 0) {
    echo "User already exists";
    return;
}

echo "Beginning to create user.";




$conn->close();
?>
