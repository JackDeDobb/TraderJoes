<?php
include 'credentials.php';

$q = $_GET["symbol"];

// $url = "https://www.alphavantage.co/query?function=BATCH_STOCK_QUOTES&symbols=";
// $url .= $q;
// $url .= "&apikey=S4TYOA5YDZJBLT1K";
// $result = file_get_contents($url);

// $array = json_decode($result, true);
//$price = $array["Stock Quotes"]["0"]["2. price"];
session_start();
$user = $_SESSION['login_user'];
$price = 100;
$quantity = 2;

// print "<h2>Response from server: {$price}</h2>";

$sql = "UPDATE Stocks SET quantity_stocks = quantity_stocks - '$quantity', prev_money_made = prev_money_made - $price WHERE ticker_symbol = '$q'"; 
$conn->query($sql);

?>
