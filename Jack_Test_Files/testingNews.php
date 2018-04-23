<?php
// setApiKey('X-AYLIEN-NewsAPI-Application-ID', '0a762ce9');

// // Configure API key authorization: app_key
// Aylien\NewsApi\Configuration::getDefaultConfiguration()->setApiKey('X-AYLIEN-NewsAPI-Application-Key', 'aa119038ef52eef4cbdff96ef724dc6f');

// $api_instance = new Aylien\NewsApi\Api\DefaultApi();

// $opts = array(
//   'text' => '"msft"',
// );

// try {
//     $result = $api_instance->listStories($opts);
//     print_r($result);
// } catch (Exception $e) {
//     echo 'Exception when calling DefaultApi->listStories: ', $e->getMessage(), "\n";
// }
$myXMLData = file_get_contents("http://finance.yahoo.com/rss/headline?s=msft");
$xml=simplexml_load_string($myXMLData);

if($xml == false) {
	echo "Failed loading XML: ";
	foreach(libxml_get_errors() as $error) {
		echo "<br>", $error->message;
	}
}
else {
	echo $xml->channel->item[1]->title . "<br>";
	echo $xml->channel->item[1]->description . "<br>";
	echo $xml->channel->item[1]->pubDate . "<br>";
	echo $xml->channel->item[1]->link . "<br>";
}
?>