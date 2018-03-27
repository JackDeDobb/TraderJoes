<?php

// get the q parameter from URL
//$q = $_REQUEST["q"];
$q = $_GET["demo-name"];
//$attr = $_GET["attr"];

// Output "no suggestion" if no hint was found or output correct values
echo "Response from server: {$q}";
?>
