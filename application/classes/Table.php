<?php
/**
 * Class Table
 */

class Table
{
    private $str;
    private $arr;
    private $header;
    private $cell;
    private $caption;

    public function  __construct($str)
    {
        $this->caption=$str;
    }

    public function open ($arr) // открытие формы
    {
        $this->str='';
        $this->setAtribyte($arr);
        return "<table $this->str>
        <caption>$this->caption</caption>
       ";
    }

    public function SetArray($arr)
    {
        $this->arr=$arr;
    }

    public function SetHeader($arr)
    {
        $this->header=$arr;
    }

    public function SetCell($arr)
    {
        return $this->cell=$arr;
    }

    public function GetTable()
    {
        $str='';
        $str.=$this->open(['border'=>1]);
        $str.=$this->GetHeader();
        foreach ($this->arr as $value)
        {
            $str.=$this->GetRow($value);
        }
        $str.=$this->close();
        return $str;
    }

    private function GetHeader()
    {
        $str="<tr>";
        foreach ($this->header as $value)
        {
            $str.="<th>$value</th>";
        }
        $str.="</tr>";
        return $str;
    }

    private function GetRow($arr)
    {
        $str="<tr>";
        foreach ($arr as $key=>$item) {
            $str.=$this->GetCell([$key=>$item]);
        }
        $str.="</tr>";
        return $str;
    }

    private function GetCell($arr)
    {
        $str="<td>";
        $type=$this->cell[key($arr)]['type'];
        $attr=$this->cell[key($arr)]['attr'];
        if ($type==null)
        {
            $str.=(current($arr));
        }else{
            $str.=$this->$type($attr,$arr);
        }
        $str.="</td>";
        return $str;
    }

    private function input($attr,$val)
    {
        $str="<input ";
        $str.=$this->setAtribyte($attr);
        $str.="value=\"".current($val)."\">";
        return $str;
    }

    private function textarea($attr,$val)
    {
        $str="<textarea ";
        $str.=$this->setAtribyte($attr).">";
        $str.=current($val);
        $str.="</textarea>";
        return $str;
    }

    private function span($attr,$val)
    {
        $str="<span ";
        $str.=$this->setAtribyte($attr).">";
        $str.=current($val);
        $str.="</span>";
        return $str;
    }

    private function setAtribyte ($arr) //парсинг массива атрибутов
    {
        $this->str='';

        while (key($arr)!=Null)
        {
            $this->str.=key($arr).'="'.$arr[key($arr)].'" ';
            next($arr);
        }

        return $this->str;
    }


    public function close () // закрытие формы
    {
        return '</table>';
    }

}