<?php
include 'credentials.php';


// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}




$tableName = User
$sql = "CREATE TABLE $tableName (
username VARCHAR(30) PRIMARY KEY,
name     VARCHAR(30) NOT NULL
)";
if ($conn->query($sql) === TRUE) {
    echo "Table $tableName created successfully\n";
} else {
    echo "Error creating table $tableName: " . $conn->error;
}









$conn->close();
?>
