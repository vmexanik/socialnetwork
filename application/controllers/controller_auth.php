<?php
/**
 * Created by PhpStorm.
 * User: Andrey
 * Date: 18.04.2019
 * Time: 19:10
 */
class Controller_auth extends Controller
{
    function __construct()
    {
        $this->view=new View();
        $this->model=new Model_auth();
    }

    function action_index()
    {
        $data=$this->model->get_data();
        $this->view->generate('authView.tpl', $data);
    }
}