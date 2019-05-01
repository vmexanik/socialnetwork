<?php
/**
 * Created by PhpStorm.
 * User: Andrey
 * Date: 25.04.2019
 * Time: 15:01
 */
class Model_register extends Model
{
    private $form;

    public function get_data()
    {
        session_start();

        if (!empty($_POST['birthday']))
        {
            if ($this->registerAction())
            {
                header("Location: /");
            }else
                {
                    return ['header' => 'Добро пожаловать!!!', 'sidebar' => '<a href="/">Главная</a><br>
                <a href="/auth">Войти</a>', 'content' => $this->regFormShow()];
            }

        }else {
            return ['header' => 'Добро пожаловать!!!', 'sidebar' => '<a href="/">Главная</a><br>
                <a href="/auth">Войти</a>', 'content' => $this->regFormShow()];
        }
    }

    function regFormShow ()
    {
        $str='';
        $this->form= new Form;
        $str.=$this->form->open(['method'=>'POST']);
        $str.='Логин<br>';
        $str.=$this->form->input(['type'=>'text', 'name'=>'login', 'value'=>$_POST['login']]);
        $str.=$messageLogin.'<p>Пароль<br>';
        $str.=$this->form->input(['type'=>'password', 'name'=>'password', 'value'=>$_POST['password']]);
        $str.=$messagePass.'<p>Подтверждение пароля<br>';
        $str.=$this->form->input(['type'=>'password', 'name'=>'confirm', 'value'=>$_POST['confirm']]);
        $str.=$messageConfirm.'<p>Дата рождения<br>';
        $str.=$this->form->input(['type'=>'date', 'name'=>'birthday', 'value'=>$_POST['birthday'], 'min'=>'1970-01-01', 'max'=>$timeNow]);
        $str.=$messageDate.'<p>E-mail<br>';
        $str.=$this->form->input(['type'=>'text', 'name'=>'email', 'value'=>$_POST['email']]);
        $str.=$messageEmail.'<p>';
        $str.=$this->form->input(['type'=>'submit', 'value'=>'Зарегистрироваться']);
        $str.=$this->form->close();
        return $str;
    }

    function registerAction ()
    {
            $login=$this->mysqli->real_escape_string($_POST['login']);
            $password=$this->mysqli->real_escape_string($_POST['password']);
            $birthday=$this->mysqli->real_escape_string($_POST['birthday']);
            $mail=$this->mysqli->real_escape_string($_POST['email']);
            $confirm=$this->mysqli->real_escape_string($_POST['confirm']);
            if (verifyer::verifyLogin($login) and
                verifyer::verifyPassword($password, $confirm) and
                verifyer::verifyEmail($mail))
            {
                $register_date=date('Y-m-d');
                $password=password_hash($password,PASSWORD_DEFAULT);

               $this->mysqli->query("INSERT INTO users SET login='$login', password='$password',
			birthday='$birthday', email='$mail', register_date='$register_date', status='user', banned='0', banDate='0000-00-00'");
                $_SESSION['message']='Регистрация успешна<p>';
                $_SESSION['auth']=true;
                $_SESSION['user']=$login;
                $id=$this->mysqli->insert_id;
                $_SESSION['id']=$id;
               return true;
        }else{
            $_SESSION['register_message']['date']='Введите дату рождения';
            return false;
        }
    }

}