<?php

require_once('classes/Form.php');

function showFormEdit ($id, $data) //показывает форму изменения даты и почты в личном кабинете
{
	$birthday=$data['birthday'];
	$email=$data['email'];
	
	$messageEmail=$_SESSION['register_message']['email'];
	$messageDate=$_SESSION['register_message']['date'];
	
	$str='';	
	$form= new Form;
	$str.=$form->open(['method'=>'POST']);
	$str.='Дата рождения:<br>';
	$str.=$form->input(['type'=>'date', 'name'=>'birthday', 'value'=>$data['birthday'], 'min'=>'1970-01-01', 'max'=>'2136-01-01']);
	$str.=$messageDate.'<p>';
	$str.='E-mail:<br>';
	$str.=$form->input(['type'=>'text', 'name'=>'email', 'value'=>$data['email']]);
	$str.=$messageEmail.'<p>';
	$str.=$form->input(['type'=>'submit', 'name'=>'Редактировать']);
	$str.='<p>';
	$str.=$form->close();

	$_SESSION['register_message']['email']=null;
	$_SESSION['register_message']['date']=null;
}

function regFormShow ($flag='SAVE') //показывает регистрационную форму
{
	$messageLogin=$_SESSION['register_message']['login'];
	$messagePass=$_SESSION['register_message']['password'];
	$messageConfirm=$_SESSION['register_message']['confirm'];
	$messageEmail=$_SESSION['register_message']['email'];
	$messageDate=$_SESSION['register_message']['date'];
	if ($flag=='SAVE'){
			$button='Зарегистрироваться';
	}
	if ($flag=='EDIT'){
			$button='Изменить';
	}
	$timeNow=date('Y-m-d');
	
	$str='';	
	$form= new Form;
	$str.=$form->open(['method'=>'POST']);
	$str.='Логин<br>';
	$str.=$form->input(['type'=>'text', 'name'=>'login', 'value'=>$_POST['login']]);
	$str.=$messageLogin.'<p>Пароль<br>';
	$str.=$form->input(['type'=>'password', 'name'=>'password', 'value'=>$_POST['password']]);
	$str.=$messagePass.'<p>Подтверждение пароля<br>';
	$str.=$form->input(['type'=>'password', 'name'=>'confirm', 'value'=>$_POST['confirm']]);
	$str.=$messageConfirm.'<p>Дата рождения<br>';
	$str.=$form->input(['type'=>'date', 'name'=>'birthday', 'value'=>$_POST['birthday'], 'min'=>'1970-01-01', 'max'=>$timeNow]);
	$str.=$messageDate.'<p>E-mail<br>';
	$str.=$form->input(['type'=>'text', 'name'=>'email', 'value'=>$_POST['email']]);
	$str.=$messageEmail.'<p>';
	$str.=$form->input(['type'=>'submit', 'value'=>$button]);
	$str.=$form->close();
		
	$_SESSION['register_message']['login']=null;
	$_SESSION['register_message']['password']=null;
	$_SESSION['register_message']['confirm']=null;
	$_SESSION['register_message']['email']=null;
	$_SESSION['register_message']['date']=null;
	return $str;
}

function verifyLogin($login, $link, $flag='SAVE') //проверяет логин на корректность
{
	if (empty($login))
	{
		$_SESSION['register_message']['login']='Логин пуст';
		return false;
	}
	if (preg_match('#^[a-zA-Z]+$#',$login)==0){
		$_SESSION['register_message']['login']='Логин должен состоять из латинских букв';
		return false;
	}
	$strlen=mb_strlen($login,'utf-8');
	if (!($strlen>=4 and $strlen<=10)){
		$_SESSION['register_message']['login']='Логин должен содержать от 4-х до 10-ти символов';
		return false;
	}
	if ($flag=='SAVE')
	{
	$query="SELECT * FROM users WHERE login='$login'";
	$reg_user=mysqli_fetch_assoc(mysqli_query($link, $query));
	if (!empty($reg_user)){
		$_SESSION['register_message']['login']='Логин занят';
		return false;
	}
	}
	return true;
}

function verifyPass($password, $confirm) //проверяет пароль на корректность
{
	if (empty($password))
	{
		$_SESSION['register_message']['password']='Пароль пуст';
		return false;
	}
	$strlen=mb_strlen($password,'utf-8');
	if (!($strlen>=6 and $strlen<=12)){
		$_SESSION['register_message']['password']='Пароль должен содержать от 6-х до 12-ти символов';
		return false;
	}
	if (empty($confirm))
	{
		$_SESSION['register_message']['confirm']='Введите подтверждение пароля';
		return false;
	}
	if ($password!=$confirm)
	{
		$_SESSION['register_message']['password']='Введённые пароли не совпадают';
		return false;
	}
	return true;
}

function verifyEMail ($mail,$link,$flag='SAVE') //проверяет почту на корректность
{
	if (empty($mail))
	{
		$_SESSION['register_message']['email']='Введите электронную почту';
		return false;
	}
	$matches=preg_match('#^[\w\._\-0-9]+@\w+\.[a-z]{2,3}$#',$mail);
	if ($matches==0)
	{
		$_SESSION['register_message']['email']='Электронная почта не корректна';
		return false;
	}
	$query="SELECT users.email FROM users";
	$result=mysqli_query($link,$query) or exit(mysqli_error($link));
	for ($data=[]; $row=mysqli_fetch_assoc($result); $data[]=$row);
	
	if ($flag=='SAVE'){
	foreach ($data as $val)
	{
		if ($mail==$val['email'])
		{
			$_SESSION['register_message']['email']='Аккаунт с данной почтой уже создан';
			return false;
		}
	}
	}
	return true;
}

function showForm () //показывает форму авторизации
{
	$str='';	
	$form= new Form;
	$str.=$form->open(['method'=>'POST']);
	$str.='Логин<br>';
	$str.=$form->input(['type'=>'text', 'name'=>'login']);
	$str.='<p>Пароль<br>';
	$str.=$form->input(['type'=>'password', 'name'=>'pass']);
	$str.='<p>';
	$str.=$form->input(['type'=>'submit', 'value'=>'Войти !']);
	$str.=$form->close();
	
	return $str;
}

function saveData ($login='', $password='', $birthday='', $email='',$data, $id, $link) //апдейтит данные в БД
{
	if ($login=='')
	{
		$login=$data['login'];
	}
	if ($password=='')
	{
		$password=$data['password'];
	}
	if ($birthday=='')
	{
		$birthday=$data['birthday'];
	}
	if ($email=='')
	{
		$email=$data['email'];
	}
	
	$query="UPDATE users SET login='$login', password='$password', birthday='$birthday', email='$email' WHERE id='$id'";
	$result=mysqli_query($link, $query) or exit(mysqli_error($link));
	return true;
}
		
function getID ($id, $link) // достаёт пользователя и вычисляет его возраст
{
	$query="SELECT * FROM users WHERE id='$id'";
	$result=mysqli_query($link, $query) or exit(mysqli_error($link));	
	$data=mysqli_fetch_assoc($result);
	
	$age=date('Y')-date('Y',strtotime($data['birthday']));
	if (date('md',strtotime($data['birthday'])) > date('md'))
	{$age--;}

	$data['age']=$age;
	
	return $data;
}


