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

if ( isset($_GET['ban']) and $_GET['ban']==0)
{
    $query="UPDATE users SET banned='0', banDate='0000-00-00' WHERE id='$id'";
    $result=mysqli_query($link, $query) or exit(mysqli_error($link));
    $_SESSION['message']='Аккаунт разбанен<p>';
    $_GET['ban']==null;
    header ('Location: main.php');
}


$sidebar='';

if ($_SESSION['auth']==true)
{ //проверка авториазции
    $header='Вы вошли как: '.$_SESSION['user'].'<p>';
    $sidebar.='<a href=main.php>Главная</a><br>';
    $sidebar.='<a href=logout.php>Выйти</a><br>';

    if ($_SESSION['status']=='admin')
    {
        $content=	"ID записи:{$data['id']}<br>
                    Логин:{$data['login']}<br>
                    Дата рождения:{$data['birthday']} ({$data['age']} лет)<br>
                    Электронная почта:{$data['email']}<p>";

        $content.= 'Забанить до:';
        $form= new Form();
        $content.=$form->open(['method'=>'POST']);
        $content.=$form->input(['type'=>'date', 'name'=>'banDate', 'min'=>'date("Y-m-d")', 'value'=>$data['banDate']]);
        $content.=$form->input(['type'=>'submit', 'value'=>'Забанить']);
        $content.='<p>';
        $content.='<a href=banProfile.php?id='.$data['id'].'&ban=0>Разбанить</a>';
        $content.=$form->close();

    }
}else {
		$content= '<a href=auth.php>Пожалуйста, авторизуйтесь</a>';
		}

include 'layout1.php';
