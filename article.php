<?php
include '/credentials.php';
session_start();
$user = $_SESSION['login_user'];
echo "User: " . $user;


$sql = "SELECT * FROM PlayerTransactions WHERE username = '$user' ORDER BY time_traded DESC";
$result = $conn->query($sql);

$tableString = "<table><tr><th>Symbol</th><th>Time Traded</th><th>Quantity</th><th>Price Per Stock</th><th>Buy/Sell</th></tr>";


while($row = $result->fetch_assoc()) {
		$tableString .= "<tr><td>" . $row["ticker_symbol"]. "</td><td>" . $row["time_traded"]. "</td><td>" . $row["quantity_stocks"] . "</td><td>" . $row["price_per_stock"] . "</td><td>" . $row["buy_or_sell"] . "</td></tr>";
}
?>

<h3>Table</h3>

	<h4>Default</h4>
	<div class="table-wrapper">
		<table>
			<thead>
				<tr>
					<th>Name</th>
					<th>Description</th>
					<th>Price</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td>Item 1</td>
					<td>Ante turpis integer aliquet porttitor.</td>
					<td>29.99</td>
				</tr>
				<tr>
					<td>Item 2</td>
					<td>Vis ac commodo adipiscing arcu aliquet.</td>
					<td>19.99</td>
				</tr>
				<tr>
					<td>Item 3</td>
					<td> Morbi faucibus arcu accumsan lorem.</td>
					<td>29.99</td>
				</tr>
				<tr>
					<td>Item 4</td>
					<td>Vitae integer tempus condimentum.</td>
					<td>19.99</td>
				</tr>
				<tr>
					<td>Item 5</td>
					<td>Ante turpis integer aliquet porttitor.</td>
					<td>29.99</td>
				</tr>
			</tbody>
			<tfoot>
				<tr>
					<td colspan="2"></td>
					<td>100.00</td>
				</tr>
			</tfoot>
		</table>
	</div>
// $myXMLData = file_get_contents("http://finance.yahoo.com/rss/headline?s=msft");
// $xml=simplexml_load_string($myXMLData);

// if($xml == false) {
// 	echo "Failed loading XML: ";
// 	foreach(libxml_get_errors() as $error) {
// 		echo "<br>", $error->message;
// 	}
// }
// else {
// 	echo $xml->channel->item[1]->title . "<br>";
// 	echo $xml->channel->item[1]->description . "<br>";
// 	echo $xml->channel->item[1]->pubDate . "<br>";
// 	echo $xml->channel->item[1]->link . "<br>";
// }