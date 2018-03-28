<?php
include 'credentials.php';

$symbol = $_GET["q"];

$url = "https://www.alphavantage.co/query?function=BATCH_STOCK_QUOTES&symbols=";
$url .= $symbol;
$url .= "&apikey=S4TYOA5YDZJBLT1K";
$result = file_get_contents($url);

$array = json_decode($result, true);
$price = $array["Stock Quotes"]["0"]["2. price"];
session_start();
print "Started";
$user = $_SESSION['login_user'];
//$q = $_SESSION['session_name'];
$quantity = 1;
print $user;
print $symbol;
print $price;

// print "<h2>Response from server: {$price}</h2>";

$sql = "INSERT INTO Stocks VALUES ('$user', '$symbol', '$quantity' , '$price')
		/*ON DUPLICATE KEY UPDATE
		Stocks.quantity_stocks = Stocks.quantity_stocks + VALUES(quantity_stocks),
		Stocks.prev_money_made = Stocks.prev_money_made + VALUES(prev_money_made)**/"; $conn->query($sql);
print "Ended";

?>
