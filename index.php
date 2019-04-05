<?php

session_start();
$header='Добро пожаловать!!!!';

$sidebar=	'<a href=register.php>Зарегистрироваться</a><br>';

// отображение флеш сообщений
if (isset($_SESSION['message']))
{
	$content= $_SESSION['message'];
	$content.='<p>';
	unset ($_SESSION['message']);
}

// если авторизация успешна то заходим на сайт
if ($_SESSION['auth']==true)
{
	$content.= 'Вы вошли как: '.$_SESSION['user'].'<p>';
	$sidebar.= '<a href=main.php>Главная</a>';
}else {
	$sidebar.='<a href=auth.php>Войти</a>';
	$content.='Тестовая заготовка под соцсеть написанная процедурным стилем. только для тренировки PHP';};

include 'layout1.php';