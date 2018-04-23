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
        // API code
        var currentPrice;
        var thered;
        var param = 'https://www.alphavantage.co/query?function=TIME_SERIES_DAILY&symbol='+symbol.toUpperCase()+'&outputsize=full&apikey=S4TYOA5YDZJBLT1K';
        $.getJSON(param, function(info) {
            //console.log(data);
            //drawChart(data, symbol);
            const monthNames = ["January", "February", "March", "April", "May", "June",
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
                {v: new Date(year, month, day2), f: (monthNames[month]+' '+day2.toString()+', '+year.toString())},
                Number(info["Time Series (Daily)"][day]["4. close"])
              ]);
            });

            var options = {
              title: 'Price of ' + symbol + ' Over Time',
              curveType: 'function'/*,
              legend: { position: 'bottom' }*/
            };

            var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));

            chart.draw(data, options);
        });

        // //sending to PHP
        // var xmlhttp = new XMLHttpRequest();
        // xmlhttp.onreadystatechange = function(){
        //   //function for the front end
        //   //this code will be executed when servers sends back response
        //   //call this.responseText to get the response from server
        //   $("#retData").innerHTML = this.responseText;
        //   // above text sets returned data in HTML, good test to see php working
        // };
        //
        // // need to write a script called processInput.php that takes the input
        // // and processes it
        // xmlhttp.open("GET", "http://mocktrading.web.engr.illinois.edu/processInput.php?q=" + symbol, true);
        // xmlhttp.send();
      }

      // example function for getting json and sending info to sever
      // function printData(){
      //   var symbol = $("#myText").val();
      //   var param = 'https://www.alphavantage.co/query?function=TIME_SERIES_INTRADAY&symbol='+symbol.toUpperCase()+'&interval=15min&outputsize=full&apikey=S4TYOA5YDZJBLT1K';
      //   $.getJSON(param, function(data) {
      //       console.log(data);
      //   });
			//
      //   var xmlhttp = new XMLHttpRequest();
      //   xmlhttp.onreadystatechange = function(){
      //     //function for the front end
      //     //this code will be executed when servers sends back response
      //     //call this.responseText to get the response from server
      //     $("#retData").innerHTML = this.responseText;
      //     // above text sets returned data in HTML, good test to see php working
      //   };
			//
      //   // need to write a script called processInput.php that takes the input
      //   // and processes it
      //   xmlhttp.open("GET", "processInput.php?q=" + symbol, true);
      //   xmlhttp.send();
      // }

			function buyStock(){
				var symbol = $("#demo-name").val().toUpperCase();
				window.location.href = "buy.php?q=" + symbol;

				// var xmlhttp = new XMLHttpRequest();
				// xmlhttp.onreadystatechange = function(){
				// 	//function for the front end
				// 	//this code will be executed when servers sends back response
				// 	//call this.responseText to get the response from server
				// 	console.log("Hi we here");
				// 	$("#test").text(Success);
				// 	// above text sets returned data in HTML, good test to see php working
				// };
				//
				// // need to write a script called processInput.php that takes the input
				// // and processes it
				// xmlhttp.open("GET", "mocktrading.web.engr.illinois.edu/buy.php?q=" + symbol, true);
				// xmlhttp.send();
			}

			function sellStock(){
				var symbol = $("#demo-name").val().toUpperCase();
				window.location.href = "sell.php?q=" + symbol;
			}

			function displayPrice(){
				var symbol = $("#demo-name").val().toUpperCase();
				var url = "https://www.alphavantage.co/query?function=BATCH_STOCK_QUOTES&symbols="+symbol+"&apikey=S4TYOA5YDZJBLT1K";
				$.getJSON(url, function(data) {
            //console.log(data);
						//$("#currPrice").innerHTML = "Current Price: " + data["Stock Quotes"]["0"]["2. price"];
						$("#currPrice").text("Current Price: $" + data["Stock Quotes"]["0"]["2. price"]);
        });
				drawChart(symbol);
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
        <div id="curve_chart" style="width: 1000px; height: 500px"></div>



      <form action="javascript:displayPrice()">
        <div class="row uniform">
          <div class="6u 12u$(xsmall)">
            <input type="text" name="symbol" id="demo-name" value="" placeholder="Ticker Symbol" />
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
              <li><a href="portfolio.php" class="button small fit">History</a></li>
            </ul>
          </div>

          </div>
        </div>

				<h2 id="currPrice">Current Price: </h2>



				<form action="javascript:displayPrice()">
					<div class="row uniform">
						<div class="6u 12u$(xsmall)">
							<input type="text" name="demo-name" id="demo-start-date" value="" placeholder="Start Date" />
						</div>
						<div class="6u$ 12u$(xsmall)">
							<input type="email" name="demo-email" id="demo-end-date" value="" placeholder="End Date" />
						</div>
					</div>
				</form>




				


    </body>






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
