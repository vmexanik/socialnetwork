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

if ($_SESSION['auth']==true){ //проверка авториазции
		echo 'Вы вошли как: '.$_SESSION['user'].'<p>';
		echo '<a href=logout.php>logout</a><p>';	
		echo '<a href=main.php>main</a><p>';

if ($_SESSION['status']=='admin')
{
	$content=	"ID записи:{$data['id']}<br>
				Логин:{$data['login']}<br>
				Дата рождения:{$data['birthday']} ({$data['age']} лет)<br>
				Эелктронная почта:{$data['email']}<br>";
	echo $content;
	
	echo 'Забанить до:
	<form method="POST">
	<input type="date" name="banDate" min="'.date('Y-m-d').'">
	<input type="submit" value="Забанить">
	</form>';
	
	

}
}else {
		echo '<a href=auth.php>Пожалуйста, авторизуйтесь</a>';
		}


