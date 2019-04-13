<?php 
//подключение БД

$host='localhost';
$user='mysql';
$pass='mysql';
	
$DBname='auth';

$link=mysqli_connect($host, $user, $pass, $DBname);