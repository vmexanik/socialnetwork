<?php
session_start();

include 'func/functions.php';
include 'func/DB_link.php';

$header='Добро пожаловать!!!!';

$sidebar='<a href=index.php>Главная</a>';

if (!empty($_POST['birthday']))
{// проверка и регистрация
	$login=$_POST['login'];
	$password=$_POST['password'];
	$birthday=$_POST['birthday'];
	$mail=$_POST['email'];
	$confirm=$_POST['confirm'];
	if (verifyLogin($login, $link) and verifyPass($password, $confirm) and verifyEMail($mail,$link,'SAVE'))
		{						
			$register_date=date('Y-m-d');
			$password=password_hash($password,PASSWORD_DEFAULT);
				
			$query="INSERT INTO users SET login='$login', password='$password',
			birthday='$birthday', email='$mail', register_date='$register_date', status='user'";
			$result=mysqli_query($link, $query) or exit(mysqli_error($link));

			$content=$_SESSION['message']='Регистрация успешна<p>';
			$_SESSION['auth']=true;
			$_SESSION['user']=$login;
			$id=mysqli_insert_id($link);
			$_SESSION['id']=$id;

			header('Location: index.php');
		}	
}else{
	$_SESSION['register_message']['date']='Введите дату рождения';
}
	
// первый вывод формы
if (empty($_POST['login']) and empty($_POST['password']) and empty($_POST['birthday']) and empty($_POST['email']) and empty($_POST['confirm'])){
	$_POST['login']='';
	$_POST['password']='';
	$_POST['birthday']='';
	$_POST['email']='';
	$_POST['confirm']='';
	$content.=regFormShow();}else{
	$content.=regFormShow();}

include 'layout1.php';

