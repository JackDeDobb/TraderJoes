<?php
include 'credentials.php';


// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}




$tableName = User
$sql = "CREATE TABLE $tableName (
username VARCHAR(30) PRIMARY KEY,
name     VARCHAR(30) NOT NULL
)";
if ($conn->query($sql) === TRUE) {
    echo "Table $tableName created successfully\n";
} else {
    echo "Error creating table $tableName: " . $conn->error;
}


$tableName = Profile
$sql = "CREATE TABLE $tableName (
username      VARCHAR(30) PRIMARY KEY,
date_created  DATE        NOT NULL,
password      VARCHAR(30) NOT NULL,
age           INTEGER     NOT NULL,
gender        BOOLEAN     NOT NULL,
email         VARCHAR(30) NOT NULL
)";
if ($conn->query($sql) === TRUE) {
    echo "Table $tableName created successfully\n";
} else {
    echo "Error creating table $tableName: " . $conn->error;
}



$tableName = Game
$sql = "CREATE TABLE $tableName (
username    VARCHAR(30) PRIMARY KEY,
start_time  TIMESTAMP   NOT NULL
)";
if ($conn->query($sql) === TRUE) {
    echo "Table $tableName created successfully\n";
} else {
    echo "Error creating table $tableName: " . $conn->error;
}


$tableName = Leaderboard
$sql = "CREATE TABLE $tableName (
username  VARCHAR(30) PRIMARY KEY,
score     INTEGER     NOT NULL
)";
if ($conn->query($sql) === TRUE) {
    echo "Table $tableName created successfully\n";
} else {
    echo "Error creating table $tableName: " . $conn->error;
}


$tableName = Overall Winners
$sql = "CREATE TABLE $tableName (
username  VARCHAR(30) PRIMARY KEY,
score     INTEGER     NOT NULL
)";
if ($conn->query($sql) === TRUE) {
    echo "Table $tableName created successfully\n";
} else {
    echo "Error creating table $tableName: " . $conn->error;
}



$tableName = Top Gainers
$sql = "CREATE TABLE $tableName (
username  VARCHAR(30) PRIMARY KEY,
score     INTEGER     NOT NULL
)";
if ($conn->query($sql) === TRUE) {
    echo "Table $tableName created successfully\n";
} else {
    echo "Error creating table $tableName: " . $conn->error;
}



$tableName = Top Losers
$sql = "CREATE TABLE $tableName (
username  VARCHAR(30) PRIMARY KEY,
score     INTEGER     NOT NULL
)";
if ($conn->query($sql) === TRUE) {
    echo "Table $tableName created successfully\n";
} else {
    echo "Error creating table $tableName: " . $conn->error;
}




$tableName = Personal History
$sql = "CREATE TABLE $tableName (
username    VARCHAR(30),
end_of_day  DATE,
amount      REAL   NOT NULL,
PRIMARY KEY(username, end_of_day)
)";
if ($conn->query($sql) === TRUE) {
    echo "Table $tableName created successfully\n";
} else {
    echo "Error creating table $tableName: " . $conn->error;
}




$tableName = Player Transaction
$sql = "CREATE TABLE $tableName (
username         VARCHAR(30),
ticker_symbol    VARCHAR(3),
time_traded      TIMESTAMP,
quantity_stocks  INTEGER    NOT NULL,
price_per_stock  REAL       NOT NULL,
buy_or_sell      BOOLEAN    NOT NULL,
PRIMARY KEY(username, ticker_symbol, time_traded)
)";
if ($conn->query($sql) === TRUE) {
    echo "Table $tableName created successfully\n";
} else {
    echo "Error creating table $tableName: " . $conn->error;
}




$tableName = Player Assets
$sql = "CREATE TABLE $tableName (
username    VARCHAR(30)  PRIMARY KEY,
cash        REAL         NOT NULL
)";
if ($conn->query($sql) === TRUE) {
    echo "Table $tableName created successfully\n";
} else {
    echo "Error creating table $tableName: " . $conn->error;
}



$tableName = Stocks
$sql = "CREATE TABLE $tableName (
username            VARCHAR(30),
ticker_symbol       VARCHAR(3),
quantity_stocks     INTEGER    NOT NULL,
prev_money_made     REAL       NOT NULL,
PRIMARY KEY(username, ticker_symbol)
)";
if ($conn->query($sql) === TRUE) {
    echo "Table $tableName created successfully\n";
} else {
    echo "Error creating table $tableName: " . $conn->error;
}









$conn->close();
?>
