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





$sql = "SELECT * FROM Stocks WHERE username = '$user' AND ticker_symbol = '$symbol'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
  echo "1 results";
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "id: " . $row["id"]. " - Name: " . $row["firstname"]. " " . $row["lastname"]. "<br>";
    }
} else {
    echo "0 results";
}

$sql = "INSERT INTO Stocks VALUES ('$user', '$symbol', '$quantity' , '$price')";
		/*ON DUPLICATE KEY UPDATE
		Stocks.quantity_stocks = Stocks.quantity_stocks + VALUES(quantity_stocks),
		Stocks.prev_money_made = Stocks.prev_money_made + VALUES(prev_money_made)**/





$conn->query($sql);
echo($user . " has successfully bought 1 stock of " . $symbol . " at " . $price . ".");
?>
