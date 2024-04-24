<?php
use application\core\Router;

Router::add('/','main/index', 'MainController','index','default');
Router::add('/login','account/login','Account','login','default');
//Router::page('/about','about/index','AboutController');

//Router::add('/admin','admin/index','AdminController' , 'index');
//Router::add('/admin/news','admin/news','AdminController','index');
Router::run();