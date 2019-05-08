<?php
/**
 * Created by PhpStorm.
 * User: Andrey
 * Date: 18.04.2019
 * Time: 17:34
 */


class Model_main extends Model
{
    private $i=0;
    public $array_users=[];

    public function get_data()
    {
        session_start();
        if ($_SESSION['auth'])
        {
            $result=$this->mysqli->query('SELECT * FROM users');
            for ($res=[]; $row=$result->fetch_array(MYSQLI_ASSOC); $res[]=$row);

            foreach ($res as $val)
           {
               $this->array_users[]=new UserSoc ($val);
               $this->i++;
           }

            $header='Вы вошли как: '.$_SESSION['login'];
            $sidebar='
            <a href="/">Главная</a><br>
            <a href="/?id='.$_SESSION['id'].'">Мой профиль</a><br>
            <a href="messages">Сообщения</a><br>
            <a href="logout">Выйти</a>
            ';

            $data=$this->ArrayToString($this->array_users);

           return ['content'=>$data,
                'sidebar'=>$sidebar,
                'footer'=>'','header'=>$header];
        }
        else{
            return ['content'=>'Тестовая заготовка под соцсеть написанная с помощью паттенрна MVC. Tолько для тренировки PHP
<p><p><p><p><p><p>',
                'sidebar'=>' <a href="/">Главная</a><br>
                            <a href=auth>Войти</a><br>
                            <a href=register>Зарегистрироваться</a>',
                'footer'=>'','header'=>'Добро пожаловать!!!'];
        }


    }



}