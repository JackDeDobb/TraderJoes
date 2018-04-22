<?php
include 'credentials.php';
session_start();
$user = $_SESSION['login_user'];
//echo $user;

$sql = "SELECT * FROM PlayerAssets WHERE username = '$user'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$tableString = "<h2>Liquid Assets: $" . $row["cash"] . "</h2>";

$sql = "SELECT * FROM Stocks WHERE username = '$user'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $tableString .= "<table><tr><th>Symbol</th><th>Quantity</th><th>Total Investment</th><th>Average Value</th></tr>";
    // output data of each row
    while($row = $result->fetch_assoc()) {
        $avgVal = $row["total_investment"] / $row["quantity_stocks"];
        $tableString .= "<tr><td>" . $row["ticker_symbol"]. "</td><td>" . $row["quantity_stocks"]. "</td><td>" . $row["total_investment"]. "</td><td>" . $avgVal . "</td></tr>";
    }
    $tableString .= "</table>";
} else {
    echo "No Stocks";
}

$conn->close();
echo $tableString;
?>


<!DOCTYPE HTML>
<!--
	Projection by TEMPLATED
	templated.co @templatedco
	Released for free under the Creative Commons Attribution 3.0 license (templated.co/license)
-->
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
					<a href="index.html">Home</a>
					<a href="search.html">Search</a>
					<a href="portfolio.php">Portfolio</a>
					<a href="login.html"><u>Login</u></a>
				</nav>
				<a href="#navPanel" class="navPanelToggle"><span class="fa fa-bars"></span></a>
			</div>







      <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {

        var data = google.visualization.arrayToDataTable([
          ['Task', 'Hours per Day'],
          ['Work',     11],
          ['Eat',      2],
          ['Commute',  2],
          ['Watch TV', 2],
          ['Sleep',    7]
        ]);

        var options = {
          title: 'My Daily Activities'
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data, options);
      }
    </script>
		</header>


		<!--HERE INSERT ALL CODE FOR PORTFOLIO-->


    <body>
      <div id="piechart" style="width: 900px; height: 500px;"></div>
    </body>





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
