<?php
/* Smarty version 3.1.33, created on 2019-05-08 21:38:31
  from 'E:\VM\OSPanel\domains\MVC\application\views\messagesView.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_5cd32227a19104_84416658',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'aafef7ef0a69167538de306443ef4ab9d09ddfbd' => 
    array (
      0 => 'E:\\VM\\OSPanel\\domains\\MVC\\application\\views\\messagesView.tpl',
      1 => 1557340711,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5cd32227a19104_84416658 (Smarty_Internal_Template $_smarty_tpl) {
?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN">
<html>
<head>
    <link href="/assets/css/messages.css" rel="stylesheet">
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
            min-height: 120px;
        }
        .footer {
            background: #8fa09b; /* Цвет фона нижнего блока-подвала */
            color: #fff; /* Цвет текста подвала */
            padding: 5px; /* Отступы внутри блока */
            clear: left; /* Отменяем действие float */
            text-align: center;
            border-radius: 0px;
        }
        table {
            width: 80%;
            border-collapse: collapse; /* Убираем двойные линии между ячейками */
        }
        td {
            width: 80%;
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
        <p><?php echo $_smarty_tpl->tpl_vars['content']->value;?>
</p>
    </div>
    <div class="footer">
        06.03.2019
    </div>

</div>
</body>
<?php echo '<script'; ?>
 src="https://code.jquery.com/jquery-3.4.0.min.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="./application/js/messages.js"><?php echo '</script'; ?>
>
</html><?php }
}
