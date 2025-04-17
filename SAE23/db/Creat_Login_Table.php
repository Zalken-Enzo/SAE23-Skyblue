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
CREATE TABLE Login (
  id_login INT PRIMARY KEY AUTO_INCREMENT,
  email VARCHAR(191) UNIQUE NOT NULL,
  password VARCHAR(255) NOT NULL,
  id_client MEDIUMINT NOT NULL,
  admin BOOLEAN DEFAULT 0,
  FOREIGN KEY (id_client) REFERENCES Client(id_client) ON DELETE CASCADE
);";

$conn -> query($sql);

$conn -> close();
?>