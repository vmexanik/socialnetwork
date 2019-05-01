<?php

class Model
{
    public $mysqli;

    public function __construct()
    {
        $this->mysqli=new mysqli('localhost','mysql','mysql','auth');
        $this->mysqli->set_charset("utf8");
        if ($this->mysqli->connect_errno)
        {
            echo 'Connection ERROR '.$this->mysqli->connect_error;
            exit();
        }
    }

    /*
        Модель обычно включает методы выборки данных, это могут быть:
            > методы нативных библиотек pgsql или mysql;
            > методы библиотек, реализующих абстракицю данных. Например, методы библиотеки PEAR MDB2;
            > методы ORM;
            > методы для работы с NoSQL;
            > и др.
    */

	// метод выборки данных
	public function get_data()
	{
		// todo
	}

	public function  ArrayToString ()
    {
        $i=0;
        $str='';
        if (is_array($this->array_users))
        {
            foreach ($this->array_users as $val)
            {
                if ($i==3)
                {
                    $i=0;
                    $str.= '</tr><tr>';
                    $str.="<td>{$val}</td>";
                }else{
                    $str.= "<td>{$val}</td>";
                }
                $i++;
            }
        }
        return $str;
    }
}