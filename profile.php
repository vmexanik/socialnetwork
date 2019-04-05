<?php
include 'func/DB_link.php';
include 'func/functions.php';

session_start();

if ($_SESSION['auth']==true){
		$header= 'Вы вошли как: '.$_SESSION['user'];
		$sidebar='<a href=main.php>Главная</a><br>';
		$sidebar.= '<a href=edit.php>Ред. профиль</a><br>';
		$sidebar.= '<a href=logout.php>Выйти</a><br>';
		
		
if (isset($_SESSION['message'])) //вывод флеш-сообщений
			{
				$content=$_SESSION['message'];
				$content.= '<p>';
				$_SESSION['message']=null;
			}

if (isset($_GET['id']) and (!isset($_POST['email']) or !isset($_POST['birthday']))) // набивка профиля юзера
{
	$id=$_GET['id'];
	$data=getID($id,$link);
	
	$content.=	"ID записи:{$data['id']}<br>
				Логин:{$data['login']}<br>
				Дата рождения:{$data['birthday']} ({$data['age']} лет)<br>
				Элeктронная почта:{$data['email']}<p>";
}

if (isset($_POST['email']) or isset($_POST['birthday'])) // сохранение данных, если изменялись
{
	$id=$_GET['id'];
	if (verifyEmail($_POST['email'],$link,'EDIT'))
	{
		
		$data=getID($id,$link);
		
		if (saveData('','',$_POST['birthday'],$_POST['email'], $data, $id, $link))
		{
			$_SESSION['message']='Редактирование успешно<p>';
		}
		$_POST['email']=null;
		$_POST['birthday']=null;
		
		header ("Location: profile.php?id=$id");
	}

}
} else{
$content.='<a href=auth.php>Пожалуйста, авторизуйтесь</a>';};

include 'layout1.php';