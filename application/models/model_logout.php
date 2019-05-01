<?php
/**
 * Created by PhpStorm.
 * User: Andrey
 * Date: 19.04.2019
 * Time: 22:33
 */

class Model_logout extends Model
{
    public function get_data()
    {
        session_start();
        if (isset($_SESSION['auth'])&$_SESSION['auth'])
        {
            session_destroy();
            header('Location:/');
        }
    }
}