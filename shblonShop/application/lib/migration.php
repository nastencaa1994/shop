<?php
use application\lib\MigrationExecFilesInDB;

$migrate = new MigrationExecFilesInDB();

$allFiles = $migrate->getMigrationFiles();
$oldArrFileNames = $migrate->getLatestMigrationData();
$newArrFileNames = $migrate->compareArrFileNames($allFiles, $oldArrFileNames);

if (empty($newArrFileNames)) {
    echo 'Ваша база данных в актуальном состоянии.';
} else {
    echo 'Начинаем миграцию...<br><br>';

    foreach ($newArrFileNames as $file) {
        $migrate->sendFileAndRecordMigration($file);
        echo '<br>'.basename($file) . '<br>';
    }
    echo '<br>Миграция завершена.';
}
