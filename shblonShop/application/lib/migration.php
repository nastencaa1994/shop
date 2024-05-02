<?php
use application\lib\CreateTable;

$migrate = new CreateTable();

$files = $migrate->getMigrationFiles();

if (empty($files)) {
    echo 'Ваша база данных в актуальном состоянии.';
} else {
    echo 'Начинаем миграцию...<br><br>';

    // Накатываем миграцию для каждого файла
    foreach ($files as $file) {
        $migrate->migrate($file);
        // Выводим название выполненного файла
        echo '<br>'.basename($file) . '<br>';
    }
    echo '<br>Миграция завершена.';
}
