<?php

namespace application\lib;

use PDO;
use PDOException;

class Db
{
    const USER_NAME = "root";
    const PASSWORD = "";
    const SERVER_NAME = "localhost";
    const NAME_DATA_BASE = 'TestShop';
    public $conn;

    public function __construct()
    {
        try {
            $this->conn = new PDO('mysql:host=localhost;dbname=TestShop', self::USER_NAME, self::PASSWORD);
        } catch (PDOException $Exception) {
            echo 'Error connection database';
            die();
        }
    }

    public function requestAndExcludeErrors($sqlRequest){
        try {
            $res = $this->conn->query($sqlRequest);
            return $res;
        } catch (PDOException $Exception) {
            return $Exception;
        }
    }

    public function addTable($nameTable, $column = [])
    {
        $primaryKeyCheck = true;
        $autoIncrementCheck = true;

        $sql = "CREATE TABLE IF NOT EXISTS " . $nameTable . " (";
        if (!empty($column)) {
            foreach ($column as $index => $items) {
                $sql .= $items["column_name"] . " " . $items["column_type"];
                if (isset($items["default"])) {
                    echo 'sss';
                    $sql .= " DEFAULT(" . $items["default"] . ")";
                }
                if (isset($items["required"]) && $items["required"]) {
                    $sql .= " NOT NULL";
                }
                if ($autoIncrementCheck && $primaryKeyCheck) {
                    if (isset($items["auto_increment"]) && $items["auto_increment"] === true) {
                        if ($autoIncrementCheck) {
                            $autoIncrementCheck = false;
                            $sql .= " AUTO_INCREMENT";
                        } else {
                            die('Error - auto_increment - only in one column');
                        }
                    }
                    if (isset($items["primary_key"]) && $items["primary_key"] === true) {
                        if ($primaryKeyCheck) {
                            $primaryKeyCheck = false;
                            $sql .= " ,PRIMARY KEY(" . $items["column_name"] . ")";
                        } else {
                            die('Error - primary_key - only in one column');
                        }
                    }
                }
                if ($index + 1 != count($column)) {
                    $sql .= ",";
                }
            }
            $sql .= ")";
           return $this->requestAndExcludeErrors($sql);
        } else {
            return '$column empty';
        }
    }

    public function deleteRowTable($nameTable, $where = [])
    {
        $sql = "DELETE FROM " . $nameTable;
        if (!empty($where)) {
            $sql .= " WHERE 1=1 ";
            foreach ($where as $key => $item) {
                $sql .= " and " . $key . " = '" . $item . "'";
            }
        }
        return $this->requestAndExcludeErrors($sql);
    }

    public function dropTable($nameTable)
    {
        if ($nameTable != '') {
            $sql = "DROP TABLE " . $nameTable;
            return $this->requestAndExcludeErrors($sql);
        }else{
            echo "The nameTable - should not be empty";
        }
    }

    //только простой запрос - более сложные в дочернем
    public function getRowTable($nameTable, $where = [], $columns = [])
    {
        $limit = 1000;
        $sql = "SELECT ";
        if (!empty($columns)) {
            foreach ($columns as $item) {
                $sql .= $item . ", ";
            }
            $sql = trim($sql, ", ");
        } else {
            $sql .= "*";
        }

        $sql .= " FROM " . $nameTable . " WHERE 1=1 ";

        if (!empty($where)) {
            foreach ($where as $key => $item) {
                $sql .= " and " . $key . " = '" . $item . "' ";
            }
        }
        $sql.='LIMIT '.$limit;

        return $this->requestDB($sql);
    }

    public function addInRowTable($nameTable, $values)
    {
        $sql = " INSERT INTO " . $nameTable . "(";
        $columnName = [];

        foreach ($values as $index => $valueItems) {
            if ($index == 0) {
                foreach ($valueItems as $key => $item) {
                    $columnName[] = $key;
                    $sql .= $key . ", ";
                }
                $sql = trim($sql, ", ");
                $sql .= ") VALUES ";
            }
            $sql .= "(";
            foreach ($columnName as $i => $name) {
                $sql .= "'" . $valueItems[$name] . "', ";
            }
            $sql = trim($sql, ", ");
            $sql .= "), ";
        }
        $sql = trim($sql, ", ");
        print_r($sql);

        return $this->requestAndExcludeErrors($sql);
    }

    public function requestDB($sql)
    {
        try {
            $result = $this->conn ->query($sql);

            $data=[];
            while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                $data[] = $row;
            }
            return $data;
        } catch (PDOException $Exception) {// не срабатывает
            echo "Error: <br>";
            print_r($Exception);
        }
    }

    public function addColumn($nameTable, $column_name, $column_type, bool $required, $default = '')
    {
        $sql = "ALTER TABLE " . $nameTable . " ADD  NOT NULL;";
        if ($column_name != '') {
            $sql .= " " . $column_name;
        } else {
            return "$column_name - не должно быть пустым";
        }
        if ($column_type != '') {
            $sql .= " " . $column_type;
        } else {
            return "$column_type - не должно быть пустым";
        }
        if (is_bool($required)) {
            if ($required) {
                $sql .= " NOT NULL";
            } else {
                if ($default != '') {
                    $sql .= " DEFAULT '" . $default . "'";
                } else {
                    $sql .= " IS NULL";
                }
            }
        } else {
            if ($default != '') {
                $sql .= " DEFAULT '" . $default . "'";
            } else {
                $sql .= " IS NULL";
            }
        }

        return $this->requestAndExcludeErrors($sql);
    }

    public function __destruct()
    {
        $this->conn = null;
    }
}