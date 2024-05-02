<?php

/** галимый не рабочий класс
 * getMigrationFiles работает некоректно
 *
 * migrate - не правильно пишет в таблицу версий и её надо доработать тоже кажись галимая
 *
 * перепиши Db на PDO и тут не забудь внедрить
 *
 * зафигач статью как допишешь на vс
 */
namespace application\lib;

use PDO;


class CreateTable extends Db
{
    function getMigrationFiles()
    {
        $sqlFolder = str_replace('\\', '/', realpath(dirname(__FILE__)) . "\\dbCreate" . '/');
        $data = [];
        $allFiles = glob($sqlFolder . '*.sql');

        $db = new PDO('mysql:host=localhost;dbname=TestShop', self::USER_NAME, self::PASSWORD);

        $result =  $db->query("show tables");
        while ($row = $result->fetch(PDO::FETCH_NUM)) {
            $data[] = $row[0];
        }


        // Первая миграция, возвращаем все файлы из папки sql
        if (count($data)<0) {
            return $allFiles;
        }

        // Ищем уже существующие миграции
        $versionsFiles = [];
        // Выбираем из таблицы versions все названия файлов
        $nameTableSQL = "SELECT name FROM versions";

        $data = $db ->query($nameTableSQL);
        while ($row = $data->fetch(PDO::FETCH_NUM)) {
            $versionsFiles[] = $row[0];
        }
        $versionsFiles = array_unique($versionsFiles);

        // Загоняем названия в массив $versionsFiles
        // Не забываем добавлять полный путь к файлу
        foreach ($data as $row) {
            array_push($versionsFiles, $sqlFolder . $row['name']);
        }
        print_r($versionsFiles);

        // Возвращаем файлы, которых еще нет в таблице versions
        return array_diff($allFiles, $versionsFiles);
    }

    function migrate($file)
    {
        $db = new PDO('mysql:host=localhost;dbname=TestShop', self::USER_NAME, self::PASSWORD);
        $sql = file_get_contents($file);
        $qr = $db->exec($sql);

        $baseName = basename($file);
        $query = sprintf('insert into `%s` (`name`) values("%s")', DB_TABLE_VERSIONS, self::NAME_DATA_BASE);
        print_r($query);

        $qr = $db->query($sql);
    }
}