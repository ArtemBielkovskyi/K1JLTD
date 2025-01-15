<?php
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
$sql = "CREATE TABLE  IF NOT EXISTS products (
  id  int NOT NULL AUTO_INCREMENT,
  productName  varchar(45) NOT NULL,
  productPrice  varchar(45) NOT NULL,
  productDescription  varchar(60) NOT NULL,
 PRIMARY KEY ( id ),
 UNIQUE KEY  id_UNIQUE  ( id )
 )";

if ($conn->query($sql) === TRUE) {
} else {
  echo "Error creating table: " . $conn->error;
}

?>