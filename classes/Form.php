<?php
/*
* в качестве аргумента подавать ассоциативный массив
* формат:
* ['атрибут'=>'значение']
* пример:
* $var->open(['action'=>'index.php', 'method'=>'POST')
*/

class Form //класс формы
{
	private $str; //строка с параметрами
	
	public function open ($arr) // открытие формы
	{
		$this->str='';
		$this->setAtribyte($arr);
		return '<form '.$this->str.'>';
	}
	
	public function input ($arr) //создание инпута
	{
		$this->str='';
		$this->setAtribyte($arr);
	
		return '<input '.$this->str.'>';
	}
	
	public function textarea($arr) //создание текстареа
	{
		$this->str='';
		$this->setAtribyte($arr);
		
		return '<textarea '.$this->str.'>'.$arr['value'].'</textarea>';
	}
	
	public function close () // закрытие формы
	{
		return '</form>';
	}

	private function setAtribyte ($arr) //парсинг массива атрибутов
	{
		while (key($arr)!=Null)
		{
			$this->str.=key($arr).'="'.$arr[key($arr)].'" ';
			next($arr);
		}
	}
}
