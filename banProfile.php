<?php
include 'func/DB_link.php'; //подключение к БД
include 'func/functions.php'; // файл с функцими

session_start();

$id=$_GET['id'];
$data=getId($id,$link);

if (isset($_POST['banDate']))
	{
		// бан  аккаунта
		$banDate=$_POST['banDate'];
		$query="UPDATE users SET banned='1', banDate='$banDate' WHERE id='$id'";
		$result=mysqli_query($link, $query) or exit(mysqli_error($link));
		$_SESSION['message']='Аккаунт забанен<p>';
		header ('Location: main.php');
}

$sidebar='';

if ($_SESSION['auth']==true){ //проверка авториазции
		$header='Вы вошли как: '.$_SESSION['user'].'<p>';
		$sidebar.='<a href=main.php>Главная</a><br>';
		$sidebar.='<a href=logout.php>Выйти</a><br>';

if ($_SESSION['status']=='admin')
{
	$content=	"ID записи:{$data['id']}<br>
				Логин:{$data['login']}<br>
				Дата рождения:{$data['birthday']} ({$data['age']} лет)<br>
				Электронная почта:{$data['email']}<br>";
	
	$content.= 'Забанить до:
	<form method="POST">
	<input type="date" name="banDate" min="'.date('Y-m-d').'">
	<input type="submit" value="Забанить">
	</form>';
	
	

}
}else {
		$content= '<a href=auth.php>Пожалуйста, авторизуйтесь</a>';
		}

include 'layout1.php';
