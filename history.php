<?php
include 'credentials.php';
session_start();
$user = $_SESSION['login_user'];
echo $user;

$tableString = "";

$sql = "SELECT * FROM Stocks WHERE username = '$user'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $tableString .= "<table><tr><th>Symbol</th><th>Quantity</th><th>Total Investment</th></tr>";
    // output data of each row
    while($row = $result->fetch_assoc()) {
        $tableString .= "<tr><td>" . $row["ticker_symbol"]. "</td><td>" . $row["quantity_stocks"]. "</td><td>" . $row["total_investment"]. "</td></tr>";
    }
    $tableString .= "</table>";
} else {
    echo "0 results";
}

$conn->close();
echo $tableString;
?>
