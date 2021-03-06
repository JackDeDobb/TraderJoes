<!DOCTYPE HTML>
<html>
	<head>
		<title>Generic - Projection by TEMPLATED</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<link rel="stylesheet" href="assets/css/main.css" />


    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(sampleStartChart);

			function sampleStartChart() {
        var data = google.visualization.arrayToDataTable([
          ['Year', 'Price'],
          ['2004',  1000],
          ['2005',  1170],
          ['2006',  660],
          ['2007',  1030]
        ]);

        var options = {
          title: 'Enter in Ticker Symbol for Graph',
        };

        var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));

        chart.draw(data, options);
      }





			function drawChart(symbol){
        var param = 'https://www.alphavantage.co/query?function=TIME_SERIES_DAILY&symbol='+symbol.toUpperCase()+'&outputsize=full&apikey=S4TYOA5YDZJBLT1K';
        $.getJSON(param, function(info) {
            const monthNames = ["sentinenial", "January", "February", "March", "April", "May", "June",
              "July", "August", "September", "October", "November", "December"
            ];

            var data = new google.visualization.DataTable();
            data.addColumn('date', 'Day');
            data.addColumn('number', 'Price');

            console.log(Object.keys(info["Time Series (Daily)"]));

            Object.keys(info["Time Series (Daily)"]).forEach(function(day){
              var year = parseInt(day.substring(0, 4));
              var month = parseInt(day.substring(5, 7));
              var day2 = parseInt(day.substring(8));
              //console.log("Year: "+year+" Day: "+day2+" Month"+month);
              data.addRow([
                {v: new Date(year, month, day2), f: (monthNames[month-1]+' '+day2.toString()+', '+year.toString())},
                Number(info["Time Series (Daily)"][day]["4. close"])
              ]);
            });

            var options = {
              title: 'Price of ' + symbol + ' Over Time',
              curveType: 'function'
            };

            var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));

            chart.draw(data, options);
        });
      }








			function buyStock(){
				var symbol = $("#tick_sym").val().toUpperCase();
				window.location.href = "buy.php?q=" + symbol;
			}

			function sellStock(){
				var symbol = $("#tick_sym").val().toUpperCase();
				window.location.href = "sell.php?q=" + symbol;
			}

			function displayPrice(){
				var symbol = $("#tick_sym").val().toUpperCase();
				var url = "https://www.alphavantage.co/query?function=BATCH_STOCK_QUOTES&symbols="+symbol+"&apikey=S4TYOA5YDZJBLT1K";
				$.getJSON(url, function(data) {
            //console.log(data);
						//$("#currPrice").innerHTML = "Current Price: " + data["Stock Quotes"]["0"]["2. price"];
						$("#currPrice").text("Current Price: $" + data["Stock Quotes"]["0"]["2. price"]);
        });
				drawChart(symbol);
				loadArticles(symbol);
			}



			function renderOneBack(numDatesBack) {
				var symbol = $("#tick_sym").val().toUpperCase();


				var param = 'https://www.alphavantage.co/query?function=TIME_SERIES_DAILY&symbol='+symbol.toUpperCase()+'&outputsize=full&apikey=S4TYOA5YDZJBLT1K';
				$.getJSON(param, function(info) {
						const monthNames = ["January", "February", "March", "April", "May", "June",
							"July", "August", "September", "October", "November", "December"
						];

						var data = new google.visualization.DataTable();
						data.addColumn('date', 'Day');
						data.addColumn('number', 'Price');

						console.log(Object.keys(info["Time Series (Daily)"]));
						var counter = 0
						Object.keys(info["Time Series (Daily)"]).forEach(function(day){
							var year = parseInt(day.substring(0, 4));
							var month = parseInt(day.substring(5, 7))-1;
							var day2 = parseInt(day.substring(8));
							var obj = new Date(year, month, day2);
							//console.log("Year: "+year+" Day: "+day2+" Month"+month);
							if(counter <= numDatesBack){
								counter = counter + 1
								data.addRow([
									{v: obj, f: (monthNames[month]+' '+day2.toString()+', '+year.toString())},
									Number(info["Time Series (Daily)"][day]["4. close"])
								]);
							}
						});

						var options = {
							title: 'Price of ' + symbol + ' Over Specified Range',
							curveType: 'function'
						};

						var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));

						chart.draw(data, options);
				});
			}




			function renderOneDay() {
				var symbol = $("#tick_sym").val().toUpperCase();
				var param = 'https://www.alphavantage.co/query?function=TIME_SERIES_INTRADAY&symbol='+symbol+'&interval=15min&outputsize=full&apikey=demoS4TYOA5YDZJBLT1K';
				$.getJSON(param, function(info) {
            const monthNames = ["January", "February", "March", "April", "May", "June",
              "July", "August", "September", "October", "November", "December"
            ];

            var data = new google.visualization.DataTable();
            data.addColumn('date', 'Day');
            data.addColumn('number', 'Price');

            console.log(Object.keys(info["Time Series (15min)"]));

            Object.keys(info["Time Series (15min)"]).forEach(function(day){
              var year = parseInt(day.substring(0, 4));
              var month = parseInt(day.substring(5, 7))-1;
              var day2 = parseInt(day.substring(8,10));
							var hour = parseInt(day.substring(11, 13));
							var min = parseInt(day.substring(14,16));
							var second = parseInt(day.substring(17));
							var today = new Date();

							var f_hour = hour, f_min = min.toString(), tod = "AM";
							if(hour > 12) f_hour = hour - 12;
							if(hour >= 12) tod = "PM";
							if(min < 10) f_min = "0"+min.toString();

							if(today.getDate() == day2 && today.getMonth() == month && today.getFullYear() == year){
								data.addRow([
									{v: new Date(year, month, day2, hour, min, second), f: (f_hour.toString()+":"+f_min+" "+tod)},
									Number(info["Time Series (15min)"][day]["4. close"])
								]);
							}
            });

            var options = {
              title: 'Price of ' + symbol + ' Over Time',
              curveType: 'function'
            };

            var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));

            chart.draw(data, options);
        });
			}


			function renderGraphDates(){
				var symbol = $("#tick_sym").val().toUpperCase();
				var start = document.getElementById("start-date").value;
				var end =  document.getElementById("end-date").value;
				start = new Date(parseInt(start.substring(0,4)), parseInt(start.substring(5,7))-1, parseInt(start.substring(8)));
				end = new Date(parseInt(end.substring(0,4)), parseInt(end.substring(5,7))-1, parseInt(end.substring(8)));
				drawChartRanges(symbol, start, end);
			}

			function drawChartRanges(symbol, start, end){
				var param = 'https://www.alphavantage.co/query?function=TIME_SERIES_DAILY&symbol='+symbol.toUpperCase()+'&outputsize=full&apikey=S4TYOA5YDZJBLT1K';
				$.getJSON(param, function(info) {
						const monthNames = ["January", "February", "March", "April", "May", "June",
							"July", "August", "September", "October", "November", "December"
						];

						var data = new google.visualization.DataTable();
						data.addColumn('date', 'Day');
						data.addColumn('number', 'Price');

						console.log(Object.keys(info["Time Series (Daily)"]));

						var firstOne = true;
						var startRangePrice = 0;

						Object.keys(info["Time Series (Daily)"]).reverse().forEach(function(day){
							var year = parseInt(day.substring(0, 4));
							var month = parseInt(day.substring(5, 7))-1;
							var day2 = parseInt(day.substring(8));
							var obj = new Date(year, month, day2);
							//console.log("Year: "+year+" Day: "+day2+" Month"+month);

							if(obj >= start && obj <= end){
								if(firstOne){
									firstOne = false;
									startRangePrice = Number(info["Time Series (Daily)"][day]["4. close"]);
								}
								var percentChange = ((Number(info["Time Series (Daily)"][day]["4. close"] - startRangePrice)) / startRangePrice).toFixed(4);
								percentChange *= 100;
								data.addRow([
									{v: obj, f: (monthNames[month]+' '+day2.toString()+', '+year.toString()+' ('+percentChange.toString()+'%)')},
									Number(info["Time Series (Daily)"][day]["4. close"])
								]);
							}
						});

						var options = {
							title: 'Price of ' + symbol + ' Over Specified Range',
							curveType: 'function'
						};

						var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));

						chart.draw(data, options);
				});
			}


    </script>
	</head>
	<body class="subpage">

		<!-- Header -->
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



      <body>
				<h2 id="currPrice">Current Price: </h2>
        <div id="curve_chart" style="width: 100%; margin-top: -40px; height: 600px;"></div>



      <form action="javascript:displayPrice()">
        <div class="row uniform">
          <div class="6u 12u$(xsmall)">
            <input type="text" name="symbol" id="tick_sym" placeholder="Ticker Symbol" />
          </div>
			</form>




          <div class="row">
            <div class="3u 12u$(small)">
              <ul class="actions vertical">
                <li><a href="#" class="button alt"></a></li>
              </ul>
            </div>

						<form action="javascript:buyStock()">
	            <div class="3u 12u$(small)">
	              <ul class="actions vertical small">
									<input type = "submit" value = "Buy">
	              </ul>
	            </div>
						</form>

						<form action="javascript:sellStock()">
            <div class="3u 12u$(small)">
              <ul class="actions vertical small">
								<input type = "submit" value = "Sell">
              </ul>
            </div>
					</form>

          <div class="3u$ 12u$(small)">
            <ul class="actions vertical small">
              <li><a href="history.php" class="button small fit">History</a></li>
            </ul>
          </div>

          </div>


					<div class="row">

						<form action="javascript:renderOneDay()">
							<div class="3u 12u$(small)">
								<ul class="actions vertical small">
									<input type = "submit" value = "Past Day">
								</ul>
							</div>
						</form>

						<form action="javascript:renderOneBack(5)">
						<div class="3u 12u$(small)">
							<ul class="actions vertical small">
								<input type = "submit" value = "Past Week">
							</ul>
						</div>
					</form>

					<form action="javascript:renderOneBack(20)">
					<div class="3u 12u$(small)">
						<ul class="actions vertical small">
							<input type = "submit" value = "Past Month">
						</ul>
					</div>
				</form>


				<form action="javascript:renderOneBack(252)">
				<div class="3u 12u$(small)">
					<ul class="actions vertical small">
						<input type = "submit" value = "Past Year">
					</ul>
				</div>
				</form>


					</div>





        </div>







				<form action="javascript:renderGraphDates()">
					<div class="row uniform">
						<div class="6u 12u$(xsmall)">
							<input type="date" id="start-date" placeholder="Start Date" />
						</div>
						<div class="6u$ 12u$(xsmall)">
							<input type="date" id="end-date" placeholder="End Date" />
						</div>
						<div class="6u$ 12u$(xsmall)">
							<input type = "submit" value = "Render Graph">
						</div>
					</div>
				</form>





  <script>
				function loadArticles(symbol) {
					var getRequest = 'http://finance.yahoo.com/rss/headline?s='+ symbol;


					document.getElementById("indexft").innerHTML = "test to start";



					var xhttp = new XMLHttpRequest();
					xhttp.onreadystatechange = function() {
						if (xhttp.readyState == 4 && xhttp.status == 200)
								callback(xhttp.responseText);
					};
					xhttp.open("GET", getRequest, true);
					xhttp.send(null);


					var text, parser, xmlDoc;
					parser = new DOMParser();
					xmlDoc = parser.parseFromString(xhttp.responseText, "text/xml");


					document.getElementById("indexft").innerHTML = "test to end";

					var content = xmlDoc.getElementsByTagName("chanel")[0].getElementsByTagName("description")[0].childNodes[0].nodeValue;

					document.getElementById("indexft").innerHTML = content;

				}
  </script>




    </body>




		<?php
		$get_request = "http://finance.yahoo.com/rss/headline?s=" . "yahoo" . $_POST['symbol'];
		$myXMLData = file_get_contents($get_request);
		$xml=simplexml_load_string($myXMLData);
		if($xml == false) {
			echo "Failed loading XML: ";
			foreach(libxml_get_errors() as $error) {
				echo "<br>", $error->message;
			}
		}
		else {
			$i = 1;
			while($xml->channel->item[$i] != false) {
				echo "<a href=\"" . $xml->channel->item[$i]->link . "\">";
				echo "<div class=\"box\">";
				echo "<header>";
				echo "<h5>" . $xml->channel->item[$i]->title . "</h5>";
				echo "<p>" . $xml->channel->item[$i]->pubDate . "</p>";
				echo "</header>";
				echo $xml->channel->item[$i]->description . "<br>";
				echo "</div>";
				echo "</a>";
				$i++;
			}
		}
		?>









		<!-- Footer -->
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

		<!-- Scripts -->
			<script src="assets/js/jquery.min.js"></script>
			<script src="assets/js/skel.min.js"></script>
			<script src="assets/js/util.js"></script>
			<script src="assets/js/main.js"></script>

	</body>
</html>
