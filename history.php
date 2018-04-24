<?php
include 'credentials.php';
session_start();
$user = $_SESSION['login_user'];
echo "User: " . $user;


$sql = "SELECT PlayerTransactions.username, PlayerTransactions.ticker_symbol, PlayerTransactions.time_traded, PlayerTransactions.quantity_stocks, PlayerTransactions.price_per_stock, PlayerTransactions.buy_or_sell, Profile.date_created FROM PlayerTransactions INNER JOIN Profile ON Profile.username = PlayerTransactions.username WHERE Profile.username = '$user' ORDER BY time_traded DESC";
$result = $conn->query($sql);

$tableString = "<table><tr><th>Symbol</th><th>Time Traded</th><th>Quantity</th><th>Price Per Stock</th><th>Buy/Sell</th></tr>";


while($row = $result->fetch_assoc()) {
		$tableString .= "<tr><td>" . $row["ticker_symbol"]. "</td><td>" . $row["time_traded"]. "</td><td>" . $row["quantity_stocks"] . "</td><td>" . $row["price_per_stock"] . "</td><td>" . $row["buy_or_sell"] . "</td></tr>";
}



$tableString .= "</table>";
$conn->close();
echo $tableString;
?>







<!DOCTYPE HTML>
<html>
	<head>
		<title>Generic - Projection by TEMPLATED</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<link rel="stylesheet" href="assets/css/main.css" />
	</head>
	<body class="subpage" onload="testTable">

		 <!--Header-->
		<header id="header">
			<div class="inner">
				<a href="https://wiki.illinois.edu/wiki/display/cs411sp18/Trader+Joe%2527s" class="logo"><strong>Trader Joe's</strong></a>
				<nav id="nav">
					<a href="index.php">Home</a>
					<a href="search.php">Search</a>
					<a href="portfolio.php">Portfolio</a>
					<a href="history.php">History</a>
					<?php
						session_start();
						if(empty($_SESSION['login_user'])) {
							echo '<a href="login.php"><u>Login</u></a>';
						} else {
							echo '<a href="logout.php"><u>Logout</u></a>';
						}
					?>
				</nav>
				<a href="#navPanel" class="navPanelToggle"><span class="fa fa-bars"></span></a>
			</div>
		</header>


		<!--HERE INSERT ALL CODE FOR HISTORY-->








		 <!--Footer-->
			<footer id="footer">
				<div class="inner">

					<h3>Get in touch</h3>

					<form action="#" method="post">

						<div class="field half first">
							<label for="name">Name</label>
							<input name="name" id="name" type="text" placeholder="Name">
						</div>
						<div class="field half">
							<label for="email">Email</label>
							<input name="email" id="email" type="email" placeholder="Email">
						</div>
						<div class="field">
							<label for="message">Message</label>
							<textarea name="message" id="message" rows="6" placeholder="Message"></textarea>
						</div>
						<ul class="actions">
							<li><input value="Send Message" class="button alt" type="submit"></li>
						</ul>
					</form>

					<div class="copyright">
						&copy; <a href="https://wiki.illinois.edu/wiki/display/cs411sp18/Trader+Joe%2527s">Trader Joe's</a>.
						 Developers: <a href="https://github.com/JackDeDobb">Jackson DeDobbelaere</a>,
						 <a href="https://github.com/rshah98626">Rahul Shah</a>,
						 <a href="https://github.com/anoopsypereddi">Anoop Sypereddi</a>.
					</div>

				</div>
			</footer>

		 <!--Scripts-->
			<script src="assets/js/jquery.min.js"></script>
			<script src="assets/js/skel.min.js"></script>
			<script src="assets/js/util.js"></script>
			<script src="assets/js/main.js"></script>


	</body>
</html>

