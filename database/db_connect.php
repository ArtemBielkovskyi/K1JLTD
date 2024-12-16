<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "k1jltd";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

?>

<!-- CREATE TABLE  userdata  (
  id  int NOT NULL AUTO_INCREMENT,
  username  varchar(45) NOT NULL,
  email  varchar(45) NOT NULL,
  password  varchar(60) NOT NULL,
 PRIMARY KEY ( id ),
 UNIQUE KEY  id_UNIQUE  ( id )
) -->