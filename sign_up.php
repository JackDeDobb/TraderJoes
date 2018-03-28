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


$sql = "INSERT INTO User(username, name, password) VALUES ({$user}, 'ok', 'no')";
$conn->query($sql);





echo "Beginning to create user.";




$conn->close();
?>
