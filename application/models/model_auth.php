<?php
/**
 * Created by PhpStorm.
 * User: Andrey
 * Date: 18.04.2019
 * Time: 19:10
 */

class Model_auth extends Model
{

    function get_data()
    {
        session_start();

        if (isset($_POST['login'])&isset($_POST['password'])&!empty($_POST['login'])&!empty($_POST['password']))
        {
            $arr=$this->get_auth($_POST['login'],$_POST['password']);
            if ($arr['responce'])
            {
                $_SESSION['auth']=true;
                $_SESSION['id']=$arr['id'];
                $_SESSION['login']=$arr['login'];
                header('Location:/');
            }else{
                return ['content'=>'You not logined'];
            }


        }else {
            return $this->showFormAuth();
        }
    }

    function showFormAuth()
    {
        $str = '';
        $form = new Form;
        $str .= $form->open(['method' => 'POST', 'class'=>'box']);
        $str .= $form->input(['type' => 'text', 'name' => 'login', 'placeholder'=>'Логин']);
        $str.='<br />';
        $str .= $form->input(['type' => 'password', 'name' => 'password', 'placeholder'=>'Пароль']);
        $str.='<br />';
        $str .= $form->input(['type' => 'submit', 'value' => 'Войти !']);
        $str .= $form->close();
        return ['header' => 'Добро пожаловать!!!',
            'content' => $str,
            'sidebar' => '<a href="/">Главная</a><br>
                        <a href=register>Зарегистрироваться</a>'];
    }

    private function get_auth($login, $password)
    {
        $login=$this->mysqli->real_escape_string($login);
        $password=$this->mysqli->real_escape_string($password);
        $result=$this->mysqli->query("SELECT * FROM users WHERE login='$login'");
        $result=$result->fetch_array(MYSQLI_ASSOC);
        $this->mysqli->close();
        if ($result!=null)
        {
            if (password_verify($password,$result['password']))
            {
                return ['responce'=>'true', 'login'=>$result['login'], 'id'=>$result['id']];
            }
        }
    }
}