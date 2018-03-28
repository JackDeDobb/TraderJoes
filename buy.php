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

//INSERT DATA CHECKS HERE





$sql = "SELECT * FROM Stocks WHERE username = '$user' AND ticker_symbol = '$symbol'";
$result = $conn->query($sql);


//Update the Stocks Table
if ($result->num_rows > 0) {
  $sql = "UPDATE Stocks SET quantity_stocks = quantity_stocks + '$quantity', total_investment = total_investment + '$price' WHERE username = '$user' AND ticker_symbol = '$symbol'";
} else {
  $sql = "INSERT INTO Stocks VALUES ('$user', '$symbol', '$quantity' , '$price')";
}
$conn->query($sql);

//Update the PlayerAssets Table
$totalSubtraction = $quantity * $price;
$sql = "UPDATE PlayerAssets SET cash = cash - '$totalSubtraction' WHERE username = '$user'";
$conn->query($sql);




echo($user . " has successfully bought 1 stock of " . $symbol . " at " . $price . ".");
?>
