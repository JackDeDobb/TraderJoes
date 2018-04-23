
<!DOCTYPE HTML>
<html>
<body>
<h3>Box</h3>
	<div class="box">
		<p>
		<?php
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
		</p>
	</div>
</body>
</html>