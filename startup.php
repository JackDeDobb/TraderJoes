<?php
include 'credentials.php';


// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}




$sql = "CREATE TABLE User (
username VARCHAR(30) PRIMARY KEY,
name     VARCHAR(30) NOT NULL
)";
if ($conn->query($sql) === TRUE) {
    echo "Table User created successfully\n";
} else {
    echo "Error creating table User: " . $conn->error;
}








$conn->close();
?>