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
$user = $_SESSION['login_user'];
$quantity = 1;


$sql = "IF EXISTS(
  SELECT *
  FROM Stocks
  WHERE username = $user AND ticker_symbol = $symbol)
  {UPDATE Stocks SET quantity_stocks = quantity_stocks + 1, total_investment = total_investment + $price WHERE username = $user AND ticker_symbol = $symbol}
  [ELSE
  {INSERT INTO Stocks VALUES ('$user', '$symbol', '$quantity' , '$price')}]";










$conn->query($sql);
echo($user . " has successfully bought 1 stock of " . $symbol . " at " . $price . ".");
?>
