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





$sql = "SELECT quantity_stocks FROM Stocks WHERE username = '$user' AND ticker_symbol = '$symbol'";
$result = $conn->query($sql);


//Update the Stocks Table
$row = $result->fetch_assoc();
if($row == false){
  echo "First buy " . $symbol . " to sell it!";
  return;
}
else if ($row["quantity_stocks"] > 1) {
  $sql = "UPDATE Stocks SET quantity_stocks = quantity_stocks - '$quantity', total_investment = total_investment - '$price' WHERE username = '$user' AND ticker_symbol = '$symbol'";
} else { //here we assume that the stock is equal to one then
  $sql = "DELETE FROM Stocks WHERE username = '$user' AND ticker_symbol = '$symbol'";
}
$conn->query($sql);

//Update the PlayerAssets Table
$totalAddition = $quantity * $price;
$sql = "UPDATE PlayerAssets SET cash = cash + '$totalAddition' WHERE username = '$user'";
$conn->query($sql);

//Update the PlayerTransactions Table
$sql = "INSERT INTO PlayerTransactions VALUES ('$user', '$symbol', CURRENT_TIMESTAMP, '$quantity', '$price', 'SELL')";
$conn->query($sql);




echo($user . " has successfully sold 1 stock of " . $symbol . " at " . $price . ".");
?>
