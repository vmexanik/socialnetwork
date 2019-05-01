<?php
/**
 * Created by PhpStorm.
 * User: Andrey
 * Date: 25.04.2019
 * Time: 14:57
 */

class Controller_register extends Controller
{
    public function __construct()
    {
        $this->view=new View();
        $this->model= new model_register();
    }

    public function action_index()
    {
        $data=$this->model->get_data();
        $this->view->generate('registerView.tpl',$data);
    }
}