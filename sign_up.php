<?php


$mysqli = new mysqli("localhost", "cs411demo_dude", "letmein!", "cs411demo_genes");

if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}

$q = $_GET["email"];

echo "Failed to connect to MySQL: (" $q;


?>
