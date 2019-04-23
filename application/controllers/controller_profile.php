<?php
/**
 * Created by PhpStorm.
 * User: Andrey
 * Date: 20.04.2019
 * Time: 13:13
 */
class Controller_profile extends Controller
{
    public function __construct()
    {
        $this->view = new View ();
        $this->model = new Model_profile();
    }

    public function action_index()
    {
        $data=$this->model->get_data();
        $this->view->generate('profileView.tpl', $data);
    }
}