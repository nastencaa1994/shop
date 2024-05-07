<?php

/**
 * зафигач статью как допишешь на vс
 */

namespace application\lib;

use application\lib\Db;
use PDO;


class CreateTable
{
    public $db;
    const DB_TABLE_VERSIONS = 'MigrateFileCheck';

    public function __construct()
    {
        $this->db = new Db();
    }

    function getMigrationFiles()
    {
        $sqlFolder = str_replace('\\', '/', realpath(dirname(__FILE__)) . "\\dbCreate" . '/');
        $data = [];
        $allFiles = glob($sqlFolder . '*.sql');

        $result = $this->db->conn->query("show tables");

        while ($row = $result->fetch(PDO::FETCH_NUM)) {
            $data[] = $row[0];
        }

        // Первая миграция, возвращаем все файлы из папки sql
        if (count($data) == 0) {
            print_r($allFiles);
            return $allFiles;
        }

        // Ищем уже существующие миграции
        $versionsFiles = [];
        // Выбираем из таблицы versions все названия файлов
        $nameTableSQL = "SELECT file FROM " . self::DB_TABLE_VERSIONS;

        $data = $this->db->conn->query($nameTableSQL);
        while ($row = $data->fetch(PDO::FETCH_OBJ)) {
            $versionsFiles[] = $row->file;
        }
        foreach ($allFiles as $index => $file) {
            if (in_array(basename($file), $versionsFiles)) {
                unset($allFiles[$index]);
            }
        }
        return $allFiles;
    }

    function migrate($file)
    {

        $sql = file_get_contents($file);

        $qr = $this->db->conn->exec($sql);

        $sqlAddMigrateTable = "INSERT INTO " . self::DB_TABLE_VERSIONS . " (file) VALUE ( '" . basename($file) . "')";

        $qr = $this->db->conn->query($sqlAddMigrateTable);

    }
}