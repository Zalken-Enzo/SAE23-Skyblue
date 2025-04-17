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
CREATE TABLE Client (
  id_client mediumint PRIMARY KEY AUTO_INCREMENT,
  nom varchar(30) NOT NULL,
  prenom char(30) NOT NULL,
  adresse char(100) NOT NULL,
  ville char(50) NOT NULL,
  mail char(100) NOT NULL,
  age tinyint unsigned
);";

$conn -> query($sql);

$conn -> close();
?>