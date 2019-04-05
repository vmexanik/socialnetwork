<?php
include 'func/DB_link.php'; //подключение к БД
include 'func/functions.php'; // файл с функцими

$content='';
$flag=false;

session_start();

$id=$_SESSION['id'];
$data=getId($id,$link);

if (isset($_POST['login']) and isset($_POST['password'])and isset($_POST['confirm'])and isset($_POST['birthday'])and isset($_POST['email']))
{
	$flag=true;
	if (preg_match('#\$2y\$10#',$_POST['password'])) //если пароль не менялся
	{
		if ($_POST['password']==$_POST['confirm'])
		{
			if (verifyEMail($_POST['email'],$link,'EDIT') and verifyLogin($_POST['login'], $link, 'EDIT'))
			{
				$content.='3';
				saveData($_POST['login'],$_POST['password'],$_POST['birthday'],$_POST['email'],$data,$id,$link);
				$_SESSION['message']='Изменение данных профиля успешно<p>';
				header ("Location: profile.php?id=$id");
			}
		}
	}else // если пароль менялся
	{
		if (verifyPass($_POST['password'], $_POST['confirm']))
		{
			$password=password_hash($_POST['password'],PASSWORD_DEFAULT);
			if (verifyEMail($_POST['email'],$link,'EDIT') and verifyLogin($_POST['login'], $link, 'EDIT'))
			{
				saveData($_POST['login'],$password,$_POST['birthday'],$_POST['email'],$data,$id,$link);
				$_SESSION['message']='Изменение данных профиля успешно<p>';
				header ("Location: profile.php?id=$id");
				
			}
		}
	}
		
		
}

if ($_SESSION['auth']==true){ //проверка авториазции
		$header= 'Вы вошли как: '.$_SESSION['user'];
		$sidebar= '<a href=main.php>Главная</a><br>';
		$sidebar.="<a href=profile.php?id={$data['id']}>Мой профиль</a><br>";
		$sidebar.= '<a href=logout.php>Выйти</a>';	
		
		


if (isset($_POST['password']) and password_verify($_POST['password'],$data['password'])) //вывод формы нового пароля
{
	$_POST['login']=$data['login'];
	$_POST['password']=$data['password'];
	$_POST['confirm']=$data['password'];
	$_POST['birthday']=$data['birthday'];
	$_POST['email']=$data['email'];
	$content.=regFormShow('EDIT');
	//$_POST['password']=null;
}
	
if ($flag)
{
	$content.=regFormShow('EDIT');
}
	
if 	(isset($_POST['password']) and !password_verify($_POST['password'],$data['password']))
{
	$_SESSION['message']['password']='Пароль не совпадает';
	//$_POST['password']=null;
}


if (!isset($_POST['password']) and $flag==false)
{ // вывод формы ввода старого пароля
	$content.= 'Введите старый пароль:<br>
		<form method="POST">
		<input type="password" name="password"> '.$_SESSION['message']['password'].'<p>
		<input type="submit" value="Изменить данные профиля"><br>
		</form>';
			$_SESSION['message']['password']=null; 
}
}else{
		$content= '<a href=auth.php>Пожалуйста, авторизуйтесь</a>';
		}

include 'layout1.php';
