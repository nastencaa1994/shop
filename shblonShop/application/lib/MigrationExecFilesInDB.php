<?php
namespace application\lib;

use application\lib\Db;
use PDO;

class MigrationExecFilesInDB
{
    public $db;
    const DB_TABLE_VERSIONS = 'migratefilecheck';

    public function __construct()
    {
        $this->db = new Db();
    }

    function getMigrationFiles()
    {
        $sqlFolder = str_replace('\\', '/', realpath(dirname(__FILE__)) . "\\dbCreate" . '/');
        $allFiles = glob($sqlFolder . '*.sql');
        return $allFiles;
    }

    public function getLatestMigrationData(){
        $result = $this->db->conn->query("show tables");
        $data = [];
        while ($row = $result->fetch(PDO::FETCH_NUM)) {
            $data[] = $row[0];
        }
        if (count($data) == 0) {
            return [];
        }
        $versionsFiles = [];
        $nameTableSQL = "SELECT file FROM " . self::DB_TABLE_VERSIONS;
        $data = $this->db->requestAndExcludeErrors($nameTableSQL);
        while ($row = $data->fetch(PDO::FETCH_OBJ)) {
            $versionsFiles[] = $row->file;
        }
        return $versionsFiles;
    }

    public function compareArrFileNames($allFiles, $oldArrFileNames){
        foreach ($allFiles as $index => $file) {
            if (in_array(basename($file), $oldArrFileNames)) {
                unset($allFiles[$index]);
            }
        }
        return $allFiles;
    }

    function sendFileAndRecordMigration($file)
    {
        $sql = file_get_contents($file);
        $qr = $this->db->conn->exec($sql);
        $this->writeNameFileInDb(basename($file));

    }

    public function writeNameFileInDb($nameFile){
        $sqlAddMigrateTable = "INSERT INTO " . self::DB_TABLE_VERSIONS . " (file) VALUE ( '" . $nameFile . "')";
        return $this->db->requestAndExcludeErrors($sqlAddMigrateTable);

    }
}