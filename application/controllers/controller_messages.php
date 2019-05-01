<?php
/**
 * Created by PhpStorm.
 * User: Andrey
 * Date: 26.04.2019
 * Time: 13:02
 */

class Controller_messages extends Controller
{
    public function __construct()
    {
        $this->view=new View();
        $this->model=new Model_messages();
    }

    public function action_index()
    {
        if ($_POST['action']=='getMessageJson')
        {
            $this->model->getMessageJson();
        };
        if ($_POST['action']!='getMessageJson' & !isset($_POST['message']))
        {
            $data=$this->model->get_data();
            $this->view->generate('messagesView.tpl', $data);
        }
        if (isset($_POST['message'])&!empty($_POST['message']))
        {
            $this->model->setMessageJson();
            $data=$this->model->get_data();
            $this->view->generate('messagesView.tpl', $data);
        }

    }
}