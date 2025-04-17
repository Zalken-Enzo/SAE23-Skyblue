<?php
define('SERVER', 'mysql:server=localhost; dbname=mydb');
define('USER', 'root');
define('PASS', '');

$connexion = new PDO(SERVER, USER, PASS);
?>