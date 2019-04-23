<?php
/**
 * Created by PhpStorm.
 * User: Andrey
 * Date: 19.04.2019
 * Time: 22:32
 */

class Controller_logout extends Controller
{
    function __construct()
    {
        $this->view=new View();
        $this->model=new Model_logout();
    }

    function action_index()
    {
        $this->model->get_data();
    }
}