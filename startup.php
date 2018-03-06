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


$sql = "CREATE TABLE OverallWinners (
username  VARCHAR(30) PRIMARY KEY,
score     INTEGER     NOT NULL
)";
if ($conn->query($sql) === TRUE) {
    echo "Table OverallWinners created successfully\n";
} else {
    echo "Error creating table OverallWinners: " . $conn->error;
}



$sql = "CREATE TABLE TopGainers (
username  VARCHAR(30) PRIMARY KEY,
score     INTEGER     NOT NULL
)";
if ($conn->query($sql) === TRUE) {
    echo "Table TopGainers created successfully\n";
} else {
    echo "Error creating table TopGainers: " . $conn->error;
}



$sql = "CREATE TABLE TopLosers (
username  VARCHAR(30) PRIMARY KEY,
score     INTEGER     NOT NULL
)";
if ($conn->query($sql) === TRUE) {
    echo "Table $tableName created successfully\n";
} else {
    echo "Error creating table TopLosers: " . $conn->error;
}




$sql = "CREATE TABLE PersonalHistory (
username    VARCHAR(30),
end_of_day  DATE,
amount      REAL   NOT NULL,
PRIMARY KEY(username, end_of_day)
)";
if ($conn->query($sql) === TRUE) {
    echo "Table PersonalHistory created successfully\n";
} else {
    echo "Error creating table PersonalHistory: " . $conn->error;
}




$sql = "CREATE TABLE PlayerTransactions (
username         VARCHAR(30),
ticker_symbol    VARCHAR(3),
time_traded      TIMESTAMP,
quantity_stocks  INTEGER    NOT NULL,
price_per_stock  REAL       NOT NULL,
buy_or_sell      BOOLEAN    NOT NULL,
PRIMARY KEY(username, ticker_symbol, time_traded)
)";
if ($conn->query($sql) === TRUE) {
    echo "Table PlayerTransactions created successfully\n";
} else {
    echo "Error creating table PlayerTransactions: " . $conn->error;
}




$sql = "CREATE TABLE PlayerAssets (
username    VARCHAR(30)  PRIMARY KEY,
cash        REAL         NOT NULL
)";
if ($conn->query($sql) === TRUE) {
    echo "Table PlayerAssets created successfully\n";
} else {
    echo "Error creating table PlayerAssets: " . $conn->error;
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
