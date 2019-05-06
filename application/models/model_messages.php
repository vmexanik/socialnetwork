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
       if (!isset($_SESSION))
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

        $dialogs=$this->mysqli->query(
            "SELECT dialogs.id_dialog FROM dialogs WHERE (id_user1= {$_SESSION['id']} OR id_user2 = {$_SESSION['id']})");
        for ($res=[]; $row=$dialogs->fetch_array(MYSQLI_ASSOC); $res[]=$row);

        $str='<table>';

        foreach ($res as $val) {
            $dialog=$this->mysqli->query("SELECT * FROM dialogs WHERE id_dialog='{$val['id_dialog']}'"); //выбираем диалог
            $dialog=$dialog->fetch_row();

            if ($dialog[1]==$_SESSION['id']) //если сессия совпадает с ИД , то выбираем имя собеседника для хидера
            {
                $opponent=$this->mysqli->query("SELECT users.login FROM users WHERE id='{$dialog[2]}'");
                $opponent=$opponent->fetch_row();
            }else{
                $opponent=$this->mysqli->query("SELECT users.login FROM users WHERE id='{$dialog[1]}'");
                $opponent=$opponent->fetch_row();
            }

            $opponent='Диалог с '. $opponent[0];

            $str.="<tr><td id='$dialog[0]'>$opponent</td></tr>";
        }

        $str.='</table><p>';

        $str.=$this->showFormMessage();


            return ['sidebar'=>$sidebar,'content'=>$str, 'header'=>$header];
    } //выводит диалоги и форму отправки сообщений

    public function getMessageJson ()
    {
        if (!isset($_SESSION))
        {
            session_start(); //стартуем сессию
        }

        $dialog=$this->mysqli->query("SELECT * FROM dialogs WHERE id_dialog='{$_POST['idDialog']}'"); //выбираем диалог
        $dialog=$dialog->fetch_array(MYSQLI_ASSOC);

        if ($dialog['id_user1']==$_SESSION['id']) //если сессия совпадает с ИД , то выбираем имя собеседника для хидера
        {
            $opponent=$this->mysqli->query("SELECT users.login FROM users WHERE id='{$dialog['id_user2']}'");
            $opponent=$opponent->fetch_row();
            $dialogOpponent=$dialog['id_user2'];
        }else{
            $opponent=$this->mysqli->query("SELECT users.login FROM users WHERE id='{$dialog['id_user1']}'");
            $opponent=$opponent->fetch_row();
            $dialogOpponent=$dialog['id_user1'];
        }

        $header='Диалог с '. $opponent[0];

        $result=$this->mysqli->query("SELECT * FROM messages WHERE id_dialog={$_POST['idDialog']}"); //выбираем все ссобщения из диалога
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
    } //метод для работы с AJAX - выдает сообщения

    public function showFormMessage()
    {
        $form= new Form();
        $str .= $form->open(['method' => 'POST', 'id'=>'ajaxForm', 'name'=>'form']);
        $str .= 'Сообщение<br>';
        $str .= $form->input(['type' => 'text', 'name' => 'message']);
        $str .= '<p>';
        $str .= $form->input(['type' => 'submit', 'value' => 'Отправить', 'name'=>'submit']);
        $str .= $form->close();

        return $str;
    } // показывает форму ввода сообщения

    public function setMessageJson() //добавляет новое сообщение по AJAX
    {
        session_start();

        $message=$this->mysqli->real_escape_string($_POST['message']);
        $_POST['message']=null;

        $this->mysqli->query(
            "INSERT INTO messages( `text`, `date_send`, `status`, `id_dialog`, `id_sender`)
                    VALUES ('$message', '".date("Y-m-d H:i:s")."' ,'1', '{$_POST['idDialog']}', '{$_SESSION['id']}')");
    }

    public function newDialog ()
    {
        if (!isset($_SESSION))
        {
            session_start();
        }

        $dialog=$this->mysqli->query(
            "SELECT dialogs.id_dialog FROM dialogs WHERE ((id_user1= {$_SESSION['id']} OR id_user1= {$_POST['id']}) AND (id_user2= {$_SESSION['id']} OR id_user1= {$_POST['id']}))");
        $dialogId=$dialog->fetch_row(); //$dialog[0]-id_dialog
        if (is_null($dialogId))
        {
            $this->mysqli->query("INSERT INTO `dialogs`(`id_user1`, `id_user2`) VALUES ('{$_SESSION['id']}','{$_POST['id']}')");
        }
        return $this->get_data();
    }
}