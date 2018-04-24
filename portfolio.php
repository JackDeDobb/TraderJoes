<?php
include 'credentials.php';
session_start();
$user = $_SESSION['login_user'];
echo "User: " . $user;






$sql = "SELECT * FROM PlayerAssets WHERE username = '$user'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$tableString2 = "<h2>Net Worth: $" . money_format('%i', $row["cash"]) . "</h2>";
$liquidForLater = $row["cash"];

$sql = "SELECT * FROM Stocks WHERE username = '$user'";
$result = $conn->query($sql);
echo $tableString2;








$sql = "SELECT * FROM PlayerAssets WHERE username = '$user'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$tableString2 = "<h2>Liquid Assets: $" . money_format('%i', $row["cash"]) . "</h2>";
$liquidForLater = $row["cash"];

$sql = "SELECT * FROM Stocks WHERE username = '$user'";
$result = $conn->query($sql);
echo $tableString2;
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







    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        <?php
        $tableString = "<table><tr><th>Symbol</th><th>Quantity</th><th>Total Investment</th><th>Average Value</th><th>Good/Bad</th></tr>";
        ?>

        var data = new google.visualization.DataTable();
          data.addColumn('string', 'Symbol');
          data.addColumn('number', 'TotalMoney');

          data.addRows([
            <?php








                $totalInvestmentNum = 0;
                while($row = $result->fetch_assoc()) {


									$get_request = "http://finance.yahoo.com/rss/headline?s=" . "appl";
									$myXMLData = file_get_contents($get_request);
									$xml=simplexml_load_string($myXMLData);
									if($xml == false) {
										echo "Failed loading XML: ";
										foreach(libxml_get_errors() as $error) {
											echo "<br>", $error->message;
										}
									}
									else {
										$ch = curl_init();
										curl_setopt($ch, CURLOPT_URL,"http://text-processing.com/api/sentiment/");
										curl_setopt($ch, CURLOPT_POST, 1);
										$i = 1;
										$totalNeg = 0
										$totalPos = 0
										while($xml->channel->item[$i] != false) {
											curl_setopt($ch, CURLOPT_POSTFIELDS, "text=" . $xml->channel->item[$i]->description);
											curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
											$server_output = curl_exec ($ch);
											$json = json_decode($server_output, true);
											$totalNeg += $json['probability']['neg'];
											$totaPos += $json['probability']['pos'];
											$i++;
										}
										curl_close ($ch);
									}
























                    $avgVal = money_format('%i', $row["total_investment"] / $row["quantity_stocks"]);
                    $tableString .= "<tr><td>" . $row["ticker_symbol"]. "</td><td>" . $row["quantity_stocks"]. "</td><td>" . money_format('%i', $row["total_investment"]) . "</td><td>" . $avgVal . "</td></tr>";
                    echo "['" . $row["ticker_symbol"] . "'," . $row["total_investment"] . "],";
                    $totalInvestmentNum += $row["total_investment"] ;
                    $stocks .= $row["ticker_symbol"] . ",";
                }
            ?>
          ]);

        var options = {
          title: 'Stock Diversity'
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart2'));
        chart.draw(data, options);
      }
    </script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {

        var data = new google.visualization.DataTable();
          data.addColumn('string', 'Asset');
          data.addColumn('number', 'TotalMoney');

          data.addRows([
            <?php
              echo "['" . "Liquid" . "'," . $liquidForLater . "],";
              echo "['" . "Stocks" . "'," . $totalInvestmentNum . "],";
            ?>
          ]);

        var options = {
          title: 'Asset Diversity'
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data, options);
      }
    </script>
		</header>


		<!--HERE INSERT ALL CODE FOR PORTFOLIO-->


    <body>
      <div id="the whole thing" style="height:500px; width:100%; overflow: hidden;">
        <div id="piechart" style="float: left; width:50%; height:500px">Left Side Menu</div>
        <div id="piechart2" style="float: left; width:50%; height:500px">Random Content</div>
      </div>
    </body>







    <?php
      $tableString .= "</table>";
      $conn->close();
      echo $tableString;
    ?>

    <h3>Related Articles</h3>

	<?php
		$get_request = "http://finance.yahoo.com/rss/headline?s=" . $stocks;
		$myXMLData = file_get_contents($get_request);
		$xml=simplexml_load_string($myXMLData);
		if($xml == false) {
			echo "Failed loading XML: ";
			foreach(libxml_get_errors() as $error) {
				echo "<br>", $error->message;
			}
		}
		else {
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL,"http://text-processing.com/api/sentiment/");
			curl_setopt($ch, CURLOPT_POST, 1);
			$i = 1;
			while($xml->channel->item[$i] != false) {
				echo "<a href=\"" . $xml->channel->item[$i]->link . "\">";
				echo "<div class=\"box\">";
				echo "<header>";
				echo "<h5>" . $xml->channel->item[$i]->title . "</h5>";
				echo "<p>" . $xml->channel->item[$i]->pubDate . "</p>";
				echo "</header>";
				curl_setopt($ch, CURLOPT_POSTFIELDS, "text=" . $xml->channel->item[$i]->description);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
				$server_output = curl_exec ($ch);
				$json = json_decode($server_output, true);
				if ($json['probability']['pos'] >= $json['probability']['neg']) {
					echo "This article has a positive sentiment!" . "<br><br>";
				} else {
					echo "This article has a negative sentiment!" . "<br><br>";
				}
				echo $xml->channel->item[$i]->description . "<br>";
				echo "</div>";
				echo "</a>";
				$i++;
			}
			curl_close ($ch);
		}
	?>
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
