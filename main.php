<?php  

session_start();

include 'func/DB_link.php';
include 'func/functions.php'; // файл с функцими

if (isset($_SESSION['message']))
	{
		$content= $_SESSION['message'];
		unset ($_SESSION['message']);
	}

$sidebar='';

if ($_SESSION['auth']==true){ 
	$header= 'Вы вошли как: '.$_SESSION['user'];
	}
	
$query="SELECT * FROM users "; // получение всех записей
$result=mysqli_query($link,$query) or exit(mysqli_error($link));
for ($data=[]; $row=mysqli_fetch_assoc($result); $data[]=$row);

if ($_SESSION['status']=='user'){
	

$content.=' Список пользователей:<p>
			<table><tr>
			<td>Имя</td>
			<td>ID</td>
			<td>Дата регистрации</td>
			</tr>';
foreach ($data as $val)
{	
	$content.="<tr><td><a href=profile.php?id={$val['id']}>{$val['login']}</a></td><td>{$val['id']}</td><td>{$val['register_date']}</td></tr>";
	if ($_SESSION['id']==$val['id'])
		{
			$sidebar.="<a href=profile.php?id={$val['id']}>Мой профиль</a><br>";
		}
	}
	$content.='</table>';
}

if ($_SESSION['status']=='admin')
{
	$content.='Список пользователей:<p>
			<table><tr>
			<td>Имя</td>
			<td>ID</td>
			<td>Дата регистрации</td>
			<td>Статус бана</td>
			<td>Удаление профиля</td>
			<td>Забанить</td>
			</tr>';
foreach ($data as $val)
{
	if ($val['banned'])
	{ $banned='Забанен';}
	else { $banned='';}
	$content.="<tr><td><a href=profile.php?id={$val['id']}>{$val['login']}</a></td><td>{$val['id']}</td><td>{$val['register_date']}</td><td>{$banned}</td><td><a href=deleteProfile.php?id={$val['id']}>Удалить</a></td><td><a href=banProfile.php?id={$val['id']}>Забанить</a></td></tr>";
	if ($_SESSION['id']==$val['id'])
		{
			$sidebar.="<a href=profile.php?id={$val['id']}>Мой профиль</a><br>";
		}
	}
	$content.='</table>';
}

if ($_SESSION['auth']==true){ 
	$sidebar.= '<a href=logout.php>Выйти</a><br>';
	}

include 'layout1.php';