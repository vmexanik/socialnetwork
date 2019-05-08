<?php
/**
 * Created by PhpStorm.
 * User: Andrey
 * Date: 08.05.2019
 * Time: 16:56
 */

class Messages
{
    private $idMessage;
    private $text;
    private $dateSend;
    private $status;
    private $idDialog;
    private $idSender;

    public function __construct($arr)
    {
        $this->idDialog=$arr['id_dialog'];
        $this->dateSend=$arr['date_send'];
        $this->idMessage=$arr['id_message'];
        $this->idSender=$arr['id_sender'];
        $this->text=$arr['text'];
        $this->status=$arr['status'];
    }


}