# socialnetwork
This is a site for practicing programming skills in the language PHP

Отрисовка с помощью шаблонизатора Smarty (https://www.smarty.net)
Путь к библиоетке шаблонизатора хранится в файле: application/core/view.php

Логика работы:

index.php - точка входа в приложение, запускает bootstrap.php
bootstrap.php - подттягивает файлы ядра (model.php, view.php, controller.php, Smarty.class.php-отрисовка, и вспомогательные классы)
Запускает роутер
route.php парсит адрес и ищет нужный контроллер
Контроллер создает экземпляр представления и модели
Модель получает данные, контроллер передает эти данные в представление
Представление отрисовывает полученные данные

Вспомогательные классы:
Form.php - выводит HTML форму,
UserSoc.php - объект пользователя

БД - auth.sql

Критика с предложениями об улучшениях приветствуется
