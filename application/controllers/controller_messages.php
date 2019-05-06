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
        if ($_POST['action']!='getMessageJson' & !isset($_POST['message']) & $_POST['action']!='newDialog')
        {
            $data=$this->model->get_data();
            $this->view->generate('messagesView.tpl', $data);
        }
        if (isset($_POST['message'])&!empty($_POST['message'])& $_POST['action']=='setMessageJson')
        {
            $this->model->setMessageJson();
        }
        if ($_POST['action']=='newDialog' & isset($_POST['id']))
        {
            $data=$this->model->newDialog();
            $this->view->generate('messagesView.tpl', $data);
        }

    }
}