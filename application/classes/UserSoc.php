<?php
/**
 * Created by PhpStorm.
 * User: Andrey
 * Date: 18.04.2019
 * Time: 21:10
 */
class UserSoc
{

    public function __construct($values = array())
    {
        foreach ($values as $k => $v) {
            $this->{$k} = $v;
       }
    }


    public function __toString()
    {
        $str="
			<a href='/?id={$this->id}'>
			<img src=\"/images/avatar.png\" align=\"bottom\" width=\"75\" height=\"75\"><br>
			Ид:{$this->id}<br>
			Логин:{$this->login}<br>
			Дата регистрации:{$this->register_date}
			</a>
			
			";

        return $str;
    }

    public function get_data()
    {
        $str="
            <img src=\"/images/avatar.png\" align=\"bottom\" width=\"200\" height=\"200\"><p>
            Ид:{$this->id}<br>
			Логин:{$this->login}<br>
			Дата регистрации:{$this->register_date}<br>
			Дата рождения:{$this->register_date}<br>
			Статус:{$this->status}<br>
			<button id=\"sendMessage\" value=\"".$this->id."\"> Отправить сообщение</button>
            ";

        return $str;
    }
}