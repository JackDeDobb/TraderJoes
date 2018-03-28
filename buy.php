<?php
include 'credentials.php';

// $q = $_GET["symbol"];

// $url = "https://www.alphavantage.co/query?function=BATCH_STOCK_QUOTES&symbols=";
// $url .= $q;
// $url .= "&apikey=S4TYOA5YDZJBLT1K";
// $result = file_get_contents($url);

// $array = json_decode($result, true);
//$price = $array["Stock Quotes"]["0"]["2. price"];
print "Started"
$user = $_SESSION['login_user'];
$price = 100;
$quantity = 2;
print $user

// print "<h2>Response from server: {$price}</h2>";

$sql = "INSERT INTO Stocks VALUES ('$user', '$q', '$quantity' , '$price')
		/*ON DUPLICATE KEY UPDATE 
		Stocks.quantity_stocks = Stocks.quantity_stocks + VALUES(quantity_stocks),
		Stocks.prev_money_made = Stocks.prev_money_made + VALUES(prev_money_made)**/"; $conn->query($sql);
print "Ended"

?>
