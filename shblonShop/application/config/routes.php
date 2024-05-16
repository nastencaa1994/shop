<?php
use application\core\Router;

Router::add('/','main/index', 'Main','index','default');
Router::add('/authorization','account/auto','Account','auto','default');
Router::add('/registration','account/registration','Account','reg','default');
Router::add('/lk','account/lk','Account','lk','default');
Router::post('/auto','Auto','authorization');
Router::post('/reg','Auto','registration');

Router::run();