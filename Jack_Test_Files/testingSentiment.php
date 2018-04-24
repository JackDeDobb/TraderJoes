<?php

$get_request = "http://text-processing.com/api/sentiment/" . "yahoo" . $_POST['symbol'];
$myXMLData = file_get_contents($get_request);
$xml=simplexml_load_string($myXMLData);
if($xml == false) {
  echo "Failed loading XML: ";
  foreach(libxml_get_errors() as $error) {
    echo "<br>", $error->message;
  }
}
else {
  echo 
}

?>
