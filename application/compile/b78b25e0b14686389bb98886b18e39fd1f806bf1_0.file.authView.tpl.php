<?php
/* Smarty version 3.1.33, created on 2019-05-08 21:13:49
  from 'E:\VM\OSPanel\domains\MVC\application\views\authView.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_5cd31c5d8702c9_39416647',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'b78b25e0b14686389bb98886b18e39fd1f806bf1' => 
    array (
      0 => 'E:\\VM\\OSPanel\\domains\\MVC\\application\\views\\authView.tpl',
      1 => 1557339227,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5cd31c5d8702c9_39416647 (Smarty_Internal_Template $_smarty_tpl) {
?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
    <link href="/assets/css/auth.css" rel="stylesheet">
    <title>ВТренировке</title>
    <style type="text/css">
        body {
            font: 10pt Arial, Helvetica, sans-serif; /* Шрифт теста */
            background: url("/images/background.jpg"); /* Цвет фона */
        }
        .container {
            width: 80%/*600px; /* Ширина слоя */
            margin: 0 auto; /* Выравнивнить весь блок по центру */
            background: #f0f0f0; /* Цвет фона левой колонки */
            border-radius: 0px;
        }
        .header {
            font: 12pt; /* Размер текста в шапке */
            text-align: center; /* Выравнивание текст шапки по центру */
            padding: 5px; /* Отступы внутри блока шапки */
            background: #8fa09b; /* Цвет фона шапки */
            color: #fff; /* Цвет текста */
            border-radius: 0px;
        }
        .sidebar {
            margin-top: -5px;
            width: 140px; /* Ширина блока */
            padding: 10px; /* Отступы внутри левого блока */
            float: left; /* Обтекание блока по правому краю */
            border-radius: 0px;
        }
        .content {
            margin-left: 150px; /* Отступ слева */
            padding: 10px; /* Отступы внутри правого блока */
            background: #fff; /* Цвет фона правого блока */
            border-radius: 0px;
            min-height: 100px;
        }
        .footer {
            background: #8fa09b; /* Цвет фона нижнего блока-подвала */
            color: #fff; /* Цвет текста подвала */
            padding: 5px; /* Отступы внутри блока */
            clear: left; /* Отменяем действие float */
            text-align: center;
            border-radius: 0px;
        }
        TABLE {
            text-align: center;
            border-collapse: collapse; /* Убираем двойные линии между ячейками */
        }
        TD {
            padding: 3px; /* Поля вокруг содержимого таблицы */
            border: 1px solid black; /* Параметры рамки */
        }

    </style>
</head>
<body>
<div class="container">
    <div class="header">
        <?php echo $_smarty_tpl->tpl_vars['header']->value;?>

    </div>
    <div class="sidebar">
        <?php echo $_smarty_tpl->tpl_vars['sidebar']->value;?>

    </div>
    <div class="content">

        <?php echo $_smarty_tpl->tpl_vars['content']->value;?>


    </div>
    <div class="footer">
        <?php echo $_smarty_tpl->tpl_vars['footer']->value;?>

        06.03.2019
    </div>
</div>
</body>
</html><?php }
}
