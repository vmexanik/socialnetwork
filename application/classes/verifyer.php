<?php
/**
 * Created by PhpStorm.
 * User: Andrey
 * Date: 25.04.2019
 * Time: 17:14
 */

class verifyer
{
    public static function verifyLogin ($login)
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
        return true;
    }

    public static function verifyPassword ($password, $confirm)
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

    public static function verifyEmail ($email)
    {
        if (empty($email))
        {
            $_SESSION['register_message']['email']='Введите электронную почту';
            return false;
        }
        $matches=preg_match('#^[\w\._\-0-9]+@\w+\.[a-z]{2,3}$#',$email);
        if ($matches==0)
        {
            $_SESSION['register_message']['email']='Электронная почта не корректна';
            return false;
        }
        return true;
    }
}