<?php
include 'credentials.php';


// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}



$sql = "CREATE TABLE User (
username VARCHAR(30) PRIMARY KEY,
name     VARCHAR(30) NOT NULL
)";
if ($conn->query($sql) === TRUE) {
    echo "Table User created successfully\n";
} else {
    echo "Error creating table User: " . $conn->error;
}


$sql = "CREATE TABLE Profile (
username      VARCHAR(30) PRIMARY KEY,
date_created  DATE        NOT NULL,
password      VARCHAR(30) NOT NULL,
age           INTEGER     NOT NULL,
gender        BOOLEAN     NOT NULL,
email         VARCHAR(30) NOT NULL
)";
if ($conn->query($sql) === TRUE) {
    echo "Table Profile created successfully\n";
} else {
    echo "Error creating table Profile: " . $conn->error;
}



$sql = "CREATE TABLE Game (
username    VARCHAR(30) PRIMARY KEY,
start_time  TIMESTAMP   NOT NULL
)";
if ($conn->query($sql) === TRUE) {
    echo "Table Game created successfully\n";
} else {
    echo "Error creating table Game: " . $conn->error;
}



$sql = "CREATE TABLE Leaderboard (
username  VARCHAR(30) PRIMARY KEY,
score     INTEGER     NOT NULL
)";
if ($conn->query($sql) === TRUE) {
    echo "Table Leaderboard created successfully\n";
} else {
    echo "Error creating table Leaderboard: " . $conn->error;
}


$sql = "CREATE TABLE Overall Winners (
username  VARCHAR(30) PRIMARY KEY,
score     INTEGER     NOT NULL
)";
if ($conn->query($sql) === TRUE) {
    echo "Table Overall Winners created successfully\n";
} else {
    echo "Error creating table Overall Winners: " . $conn->error;
}



$sql = "CREATE TABLE Top Gainers (
username  VARCHAR(30) PRIMARY KEY,
score     INTEGER     NOT NULL
)";
if ($conn->query($sql) === TRUE) {
    echo "Table Top Gainers created successfully\n";
} else {
    echo "Error creating table Top Gainers: " . $conn->error;
}



$sql = "CREATE TABLE Top Losers (
username  VARCHAR(30) PRIMARY KEY,
score     INTEGER     NOT NULL
)";
if ($conn->query($sql) === TRUE) {
    echo "Table $tableName created successfully\n";
} else {
    echo "Error creating table Top Losers: " . $conn->error;
}




$sql = "CREATE TABLE Personal History (
username    VARCHAR(30),
end_of_day  DATE,
amount      REAL   NOT NULL,
PRIMARY KEY(username, end_of_day)
)";
if ($conn->query($sql) === TRUE) {
    echo "Table Personal History created successfully\n";
} else {
    echo "Error creating table Personal History: " . $conn->error;
}




$sql = "CREATE TABLE Player Transactions (
username         VARCHAR(30),
ticker_symbol    VARCHAR(3),
time_traded      TIMESTAMP,
quantity_stocks  INTEGER    NOT NULL,
price_per_stock  REAL       NOT NULL,
buy_or_sell      BOOLEAN    NOT NULL,
PRIMARY KEY(username, ticker_symbol, time_traded)
)";
if ($conn->query($sql) === TRUE) {
    echo "Table Player Transactions created successfully\n";
} else {
    echo "Error creating table Player Transactions: " . $conn->error;
}




$sql = "CREATE TABLE Player Assets (
username    VARCHAR(30)  PRIMARY KEY,
cash        REAL         NOT NULL
)";
if ($conn->query($sql) === TRUE) {
    echo "Table Player Assets created successfully\n";
} else {
    echo "Error creating table Player Assets: " . $conn->error;
}



$sql = "CREATE TABLE Stocks (
username            VARCHAR(30),
ticker_symbol       VARCHAR(3),
quantity_stocks     INTEGER    NOT NULL,
prev_money_made     REAL       NOT NULL,
PRIMARY KEY(username, ticker_symbol)
)";
if ($conn->query($sql) === TRUE) {
    echo "Table Stocks created successfully\n";
} else {
    echo "Error creating table Stocks: " . $conn->error;
}









$conn->close();
?>
