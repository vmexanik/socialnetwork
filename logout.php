<?php
// разлогин
session_start();
$_SESSION['auth']=null;
$_SESSION['user']=null;
$_SESSION['id']=null;
$_SESSION['message']='Logout succesfull';
header ('Location: index.php');