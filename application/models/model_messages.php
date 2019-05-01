<?php
/**
 * Created by PhpStorm.
 * User: Andrey
 * Date: 26.04.2019
 * Time: 13:05
 */

class Model_messages extends Model
{
    public function get_data()
    {
       if (!isset($_SESSION)&empty($_SESSION))
       {
           session_start();
       }


        $header='Вы вошли как: '.$_SESSION['login'];

        $sidebar='
            <a href="/">Главная</a><br>
            <a href="/?id='.$_SESSION['id'].'">Мой профиль</a><br>
            <a href="messages">Сообщения</a><br>
            <a href="logout">Выйти</a>
            ';

            return ['sidebar'=>$sidebar,'content'=>$this->showFormMessage(), 'header'=>$header];
    }

    public function getMessageJson ()
    {
        session_start(); //стартуем сессию

        $dialog=$this->mysqli->query("SELECT * FROM dialogs WHERE id_dialog='1'"); //выбираем диалог
        $dialog=$dialog->fetch_row();

        if ($dialog[1]==$_SESSION['id']) //если сессия совпадает с ИД , то выбираем имя собеседника для хидера
        {
            $opponent=$this->mysqli->query("SELECT users.login FROM users WHERE id='{$dialog[2]}'");
            $opponent=$opponent->fetch_row();
            $dialogOpponent=$dialog[2];
        }else{
            $opponent=$this->mysqli->query("SELECT users.login FROM users WHERE id='{$dialog[1]}'");
            $opponent=$opponent->fetch_row();
            $dialogOpponent=$dialog[1];
        }

        $header='Диалог с '. $opponent[0];

        $result=$this->mysqli->query("SELECT * FROM messages WHERE id_dialog='1'"); //выбираем все ссобщения из диалога
        for ($res=[]; $row=$result->fetch_array(MYSQLI_ASSOC); $res[]=$row);

        foreach ($res as $val)
        {
            if ($val['id_sender']==$_SESSION['id'])
            {
                $message=['text'=>'Я:<br>'.$val['text'].'<br>', 'date_send'=>$val['date_send'], 'sender'=>'user'];
            }
            if ($val['id_sender']==$dialogOpponent)
            {
                $message=['text'=>$opponent[0].':<br>'.$val['text'].'<br>', 'date_send'=>$val['date_send'], 'sender'=>'oponent'];
            }
            $messages[]=$message;
        }

        header('Content-type: application/json');
        $arr=['header'=> $header, 'text'=> $messages];
        echo json_encode($arr);
    }

    public function showFormMessage()
    {
        $form= new Form();
        $str .= $form->open(['method' => 'POST', 'id'=>'ajaxForm']);
        $str .= 'Сообщение<br>';
        $str .= $form->input(['type' => 'text', 'name' => 'message']);
        $str .= '<p>';
        $str .= $form->input(['type' => 'submit', 'value' => 'Отправить']);
        $str .= $form->close();

        return $str;
    }

    public function setMessageJson()
    {
        session_start();

        $message=$this->mysqli->real_escape_string($_POST['message']);
        $_POST['message']=null;

        $this->mysqli->query(
            "INSERT INTO messages( `text`, `date_send`, `status`, `id_dialog`, `id_sender`)
                    VALUES ('$message', '".date("Y-m-d H:i:s")."' ,'1', '1', '{$_SESSION['id']}')");
    }
}