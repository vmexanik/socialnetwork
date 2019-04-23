<?php
/**
 * Created by PhpStorm.
 * User: Andrey
 * Date: 20.04.2019
 * Time: 13:14
 */
class Model_profile extends Model
{
    private $i=0;
    public $array_users=[];

    function get_data()
    {
        session_start();

        if ($_SESSION['auth']&isset($_POST['id']))
        {
            $result=$this->mysqli->query("SELECT * FROM users WHERE id='{$_POST['id']}'");
            for ($res=[]; $row=$result->fetch_array(MYSQLI_ASSOC); $res[]=$row);

            foreach ($res as $val)
            {
                $this->array_users[]=new UserSoc ($val);
            }

            $header='Вы вошли как: '.$_SESSION['login'];
            $sidebar='
            <a href="/">Главная</a><br>
            <a href="?id='.$_SESSION['id'].'">Мой профиль</a><br>
            <a href="logout">Выйти</a>
            ';

            $data=$this->array_users[0]->get_data();

            return ['content'=> $data,
                'sidebar'=>$sidebar,
                'footer'=>'','header'=>$header];

        }
    }
}