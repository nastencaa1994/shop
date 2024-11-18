<?php
use application\core\Router;
// страницы
Router::add('/','main/index', 'Main','index','default'); // главная стараница
Router::add('/authorization','account/auto','Account','auto','default'); // страница асторизации
Router::add('/registration','account/registration','Account','reg','default'); // страница регистрации
Router::add('/lk','account/lk','Account','lk','default');  // главная страница личного кабинета

// запроссы
Router::post('/auto','Auto','authorization'); // авторизация
Router::post('/reg','Auto','registration'); // регистрация

Router::run(); // активация маршрутов указаных выше