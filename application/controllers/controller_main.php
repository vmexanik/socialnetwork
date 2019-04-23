<?php
/**
 * Created by PhpStorm.
 * User: Andrey
 * Date: 18.04.2019
 * Time: 17:32
 */
class Controller_main extends Controller
{
    function __construct()
    {
        $this->model= new Model_main();
        $this->view=new View();
    }

    function action_index()
    {
        $data=$this->model->get_data();
        $this->view->generate('mainView.tpl', $data);

    }
}