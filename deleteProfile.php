<?php
include 'func/DB_link.php'; //подключение к БД
include 'func/functions.php'; // файл с функцими

session_start();

$id=$_GET['id'];
$data=getId($id,$link);

if (isset($_POST['password'])){ //удаление аккаунта
	if (password_verify($_POST['password'],$data['password']))
		{
			$query="DELETE FROM users WHERE id='$id'";
			$result=mysqli_query($link, $query) or exit(mysqli_error($link));
			$_SESSION['message']='Аккаунт удален успешно<p>';
			$_SESSION['auth']=false;
			header ('Location: index.php');
		}else{
			$_SESSION['message']['password']='Пароль не совпадает';
			$_POST['password']=null;
			}
}

if ($_SESSION['status']=='admin')
{
	$query="DELETE FROM users WHERE id='$id'";
	$result=mysqli_query($link, $query) or exit(mysqli_error($link));
	$_SESSION['message']='Аккаунт удален успешно<p>';
	header ('Location: main.php');
}

if ($_SESSION['auth']==true){ //проверка авториазции
		echo 'Вы вошли как: '.$_SESSION['user'].'<p>';
		echo '<a href=logout.php>logout</a><p>';	
		echo '<a href=main.php>main</a><p>';
		

if (!isset($_POST['password'])){ // вывод формы ввода пароля
	echo 'Введите старый пароль:<br>
		<form method="POST">
		<input type="password" name="password"> '.$_SESSION['message']['password'].'<p>
		<input type="submit" value="Удалить профиль"><br>
		</form>';
			$_SESSION['message']['password']=null; 
}
}else{
		echo '<a href=auth.php>Пожалуйста, авторизуйтесь</a>';
		}


