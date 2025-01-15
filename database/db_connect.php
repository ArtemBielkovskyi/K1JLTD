<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "K1JLTD";

// Create connection
$conn = new mysqli($servername, $username, $password);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Create database
$sql = "CREATE DATABASE IF NOT EXISTS $dbname";
if ($conn->query($sql) === TRUE) {
} else {
  echo "Error creating database: " . $conn->error;
}
$conn->close();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "K1JLTD";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// sql to create table
$sql = "CREATE TABLE  IF NOT EXISTS userdata  (
  id  int NOT NULL AUTO_INCREMENT,
  username  varchar(45) NOT NULL,
  email  varchar(45) NOT NULL,
  password  varchar(60) NOT NULL,
  accountType varchar(45) NOT NULL,
  last_login varchar(45) NOT NULL,
 PRIMARY KEY ( id ),
 UNIQUE KEY  id_UNIQUE  ( id )
 )";

if ($conn->query($sql) === TRUE) {
} else {
  echo "Error creating table: " . $conn->error;
}

?>