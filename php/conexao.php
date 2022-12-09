<?php

$username = 'root';
$password = '';

$connect = new PDO('mysql:host=localhost;dbname=rejisukan;charset=utf8', $username, $password, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
$connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);



?>