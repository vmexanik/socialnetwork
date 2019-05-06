<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN">
<html>
<head>
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
        td.oponent
        {
            background: white;
            text-align: right;
        }
        td.user
        {
            background: #E8E6D1;
            text-align: left;
        }


    </style>
</head>
<body>
<div class="container">
    <div class="header">
        {$header}
    </div>
    <div class="sidebar">
        {$sidebar}
    </div>
    <div class="content">
        <p>{$content}</p>
    </div>
    <div class="footer">
        {$footer}
        06.03.2019
    </div>

</div>
</body>
<script src="https://code.jquery.com/jquery-3.4.0.min.js"></script>
<script src="./application/js/messages.js"></script>
</html>