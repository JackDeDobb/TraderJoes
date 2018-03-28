<?php
include 'credentials.php';

$q = $_GET["symbol"];

$url = "https://www.alphavantage.co/query?function=BATCH_STOCK_QUOTES&symbols=";
$url .= $q;
$url .= "&apikey=S4TYOA5YDZJBLT1K";
$result = file_get_contents($url);

$array = json_decode($result, true);
$price = $array["Stock Quotes"]["0"]["2. price"];

echo $price;
$price = (int)$price

$sql = "INSERT INTO Stocks VALUES ('$user', '$q', 1 , '$price')"; $conn->query($sql);

?>
