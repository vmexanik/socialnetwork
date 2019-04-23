<?php

class View
{

	function generate($content_view, $data = null)
	{
        $smartySocialnetwork= new Smarty();

        $smartySocialnetwork->template_dir = 'E:/VM/OSPanel/domains/MVC/application/views';
        $smartySocialnetwork->compile_dir = 'E:/VM/OSPanel/domains/MVC/application/compile';
        $smartySocialnetwork->config_dir = 'E:/VM/OSPanel/domains/MVC/application';
        $smartySocialnetwork->cache_dir = 'E:/VM/OSPanel/domains/MVC/application';

        $smartySocialnetwork->assign($data);

        $smartySocialnetwork->display($content_view);


	}
}
