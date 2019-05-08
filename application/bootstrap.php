<?php

// подключаем файлы ядра
require_once 'core/model.php';
require_once 'core/view.php';
require_once 'core/controller.php';
require_once 'E:/VM/OSPanel/domains/libs/Smarty.class.php';
require_once 'E:/VM/OSPanel/domains/MVC/application/classes/UserSoc.php';
require_once 'E:/VM/OSPanel/domains/MVC/application/classes/form.php';
require_once 'E:/VM/OSPanel/domains/MVC/application/classes/verifyer.php';
require_once 'E:/VM/OSPanel/domains/MVC/application/classes/Messages.php';


/*
Здесь обычно подключаются дополнительные модули, реализующие различный функционал:
	> аутентификацию
	> кеширование
	> работу с формами
	> абстракции для доступа к данным
	> ORM
	> Unit тестирование
	> Benchmarking
	> Работу с изображениями
	> Backup
	> и др.
*/

require_once 'core/route.php';
Route::start(); // запускаем маршрутизатор
