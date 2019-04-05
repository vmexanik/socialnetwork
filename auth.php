<?php
error_reporting(E_ALL);

include 'func/DB_link.php';
include 'func/functions.php';

$header='Добро пожаловать!!!!';

$sidebar=	'<a href=register.php>Зарегистрироваться</a>';
// процедура авторизации
if (!empty($_POST['login']) and !empty($_POST['pass']))
{
	$login=$_POST['login'];
	
	$query="SELECT * FROM users WHERE login='$login'";
	$result=mysqli_query($link, $query) or exit(mysqli_error($link));
	
	$user=mysqli_fetch_assoc($result);
	$passwd=password_verify($_POST['pass'],$user['password']);	
// если логин и пароль корректен и найдены в БД
	if (!empty($user) and $passwd)
	{
		// проверяем на бан, если бан не снят, то пишем сколько дней до разбана
		$dateNow=mktime(00,00,01);
		$date=explode('-',$user['banDate']);
		$banDate=mktime(00,00,01,$date[1],$date[2],$date[0]);		
		$dateRazban=floor(($banDate-$dateNow)/(60*60*24));
		
		if ($user['banDate']==date('Y-m-d'))
		{
			// разбан если время бана истекло
			$query="UPDATE users SET banned='0', banDate='0000-00-00' WHERE login='$login'";
			$result=mysqli_query($link, $query) or exit(mysqli_error($link));
			$user['banned']=false;
		}
		
		if ($user['banned']==true and $dateRazban!=0)
		{
			$content= 'Ваш аккаунт забанен за нарушение правил сайта.<br> Автоматический разбан произойдёт через '.$dateRazban.' дней';
		}else{
		// флеш сообщения
		session_start();
		$_SESSION['status']=$user['status'];
		$_SESSION['message']='Авторизация прошла успешно<p>';
		$_SESSION['auth']=true;
		$_SESSION['id']=$user['id'];
		$_SESSION['user']=$login;
		header ('Location: main.php');
	} 
	}
	else {
		$content= 'Логин или пароль не верны, пройдите авторизацию заново';
		$content.=showForm();
	}
}
// показ формы авторизации
if (!isset($_POST['login']))
{
	$content=showForm();
}

include 'layout1.php';
