<?php

// get the q parameter from URL
$q = $_REQUEST["q"];

// Output "no suggestion" if no hint was found or output correct values
echo "Response from server: {$q}";
?>
