<?php
define('SERVER', 'mysql:server=localhost; dbname=SAE23');
define('USER', 'root');
define('PASS', '');

$connexion = new PDO(SERVER, USER, PASS);
?>