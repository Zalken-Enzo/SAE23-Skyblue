<?php
$servername = "localhost";
$username = "root";

// Create connection
$conn = new mysqli($servername, $username);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql = "CREATE DATABASE IF NOT EXISTS mydb ";
$conn -> query($sql);

$sql = "USE mydb;";
$conn -> query($sql);

$sql = "
CREATE TABLE Commande (
  id_comm mediumint unsigned AUTO_INCREMENT,
  id_client mediumint,
  date date NOT NULL,
  FOREIGN KEY (id_client) REFERENCES Client (id_client),
  PRIMARY KEY (id_comm, id_client)
);";

$conn -> query($sql);

$conn -> close();
?>