<html>
 <head>
  <title>ВТренировке</title>
  <style>
 body {
    font: 10pt Arial, Helvetica, sans-serif; /* Шрифт теста */
    background: #e1dfb9; /* Цвет фона */
   }
    .container {
    width: 600px; /* Ширина слоя */
    margin: 0 auto; /* Выравнивнить весь блок по центру */
    background: #f0f0f0; /* Цвет фона левой колонки */
	border-radius: 5px;
   }
   .header {
    font: 12pt; /* Размер текста в шапке */
    text-align: center; /* Выравнивание текст шапки по центру */
	padding: 5px; /* Отступы внутри блока шапки */
    background: #8fa09b; /* Цвет фона шапки */
    color: #fff; /* Цвет текста */
	border-radius: 5px;
   }
   .sidebar {
    margin-top: -5px;
    width: 140px; /* Ширина блока */
    padding: 10px; /* Отступы внутри левого блока */
    float: left; /* Обтекание блока по правому краю */
	border-radius: 5px;
   }
   .content {
    margin-left: 150px; /* Отступ слева */
    padding: 10px; /* Отступы внутри правого блока */
    background: #fff; /* Цвет фона правого блока */
	border-radius: 5px;
   }
   .footer {
    background: #8fa09b; /* Цвет фона нижнего блока-подвала */
    color: #fff; /* Цвет текста подвала */
    padding: 5px; /* Отступы внутри блока */
    clear: left; /* Отменяем действие float */
	text-align: center;
	border-radius: 5px;
   }
  </style>
 </head>
 <body>
  <div class="container">
   <div class="header">
		<?=$header?>
   </div>
   <div class="sidebar">
			<?=$sidebar?>
   </div>
   <div class="content">
		<?=$content?>
	</div>
	<div class="footer">
		<?php
		include 'footer.php';
		?> <br>
		06.03.2019
	</div>
	</div>
	</body>
	</html>