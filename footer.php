<?php
include 'func/DB_link.php';
// вывод кол-ва зареганных пользователей
$query="SELECT COUNT(id) AS count FROM users";

$result=mysqli_query($link, $query) or exit(mysqli_error($link));
$count=mysqli_fetch_assoc($result);

echo 'Зарегистрированых пользователей: '.$count['count'];