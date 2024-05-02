<?php

namespace application\lib;

class Db
{
    const USER_NAME = "root";
    const PASSWORD = "";
    const SERVER_NAME = "localhost";
    const NAME_DATA_BASE = 'TestShop';
    public $conn;

    public function __construct()
    {
        $this->conn = mysqli_connect(self::SERVER_NAME, self::USER_NAME, self::PASSWORD, self::NAME_DATA_BASE);
        if (!$this->conn) {
            die("Connection failed: " . mysqli_connect_error());
        }
    }

    public function addTable($nameTable, $column = [])
    {

        $primaryKeyCheck = true;
        $autoIncrementCheck = true;
        $sql = "CREATE TABLE IF NOT EXISTS " . $nameTable . " (";
        if(!empty($column)){
            foreach ($column as $index => $items) {

                $sql .= $items["column_name"] . " " . $items["column_type"] ;
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
                            $sql .= " ,PRIMARY KEY(".$items["column_name"].")";
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
        if (mysqli_query($this->conn, $sql)) {
            echo "Table " . $nameTable . " created successfully";
        } else {
            echo "Error creating table: " . mysqli_error($this->conn);
        }
        }else{
            return '$column empty';
        }
    }

    public function deleteRowTable($nameTable, $where = [])
    {
        $sql = "DELETE FROM " . $nameTable;
        if (!empty($where)) {
            $sql .= " WHERE 1=1 ";
            foreach ($where as $key => $item) {
                $sql .= " and " . $key . " = '" . $item."'";
            }
        }
        if (mysqli_query($this->conn, $sql)) {
            echo "Table " . $nameTable . "  delete row";
        } else {
            echo "Error delete table: " . mysqli_error($this->conn);
        }
    }

    public function dropTable($nameTable)
    {

        $sql = "DROP TABLE " . $nameTable;

        if (mysqli_query($this->conn, $sql)) {
            echo "Table " . $nameTable . "  drop";
        } else {
            echo "Error drop table: " . mysqli_error($this->conn);
        }
    }

    //только простой запрос - более сложные в дочернем
    public function getRowTable(string $nameTable, $where = [], $columns = [])
    {
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

        if(!empty($where)){
            foreach ($where as $key=>$item){
                $sql .=  " and ".$key." = '". $item."' " ;
            }
        }
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
                $sql .= "'".$valueItems[$name] . "', ";
            }
            $sql = trim($sql, ", ");
            $sql .= "), ";
        }
        $sql = trim($sql, ", ");
        if (mysqli_query($this->conn, $sql)) {
            return true;
        } else {
            return "Error INSERT table: " . mysqli_error($this->conn);
        }
    }

    public function requestDB($sql){
        $ret=[];
        $result = mysqli_query($this->conn, $sql);
        if( $result === false ) {
            print_r($sql);
            return ( print_r( mysqli_errors(), true));
        }
        while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            $ret['Items'][] = $row;
        }
        if (array_key_exists('Items', $ret)) {
            $ret['Total'] = count($ret['Items']);
        }
        else {
            $ret['Total'] = 0;
        }
        return $ret;

    }

    public function addColumn($nameTable,$column_name,$column_type, bool $required, $default = ''){
        $sql = "ALTER TABLE ".$nameTable." ADD  NOT NULL;";
        if($column_name!=''){
            $sql .= " ".$column_name;
        }else{
            return "$column_name - не должно быть пустым";
        }
        if($column_type!=''){
            $sql .= " ".$column_type;
        }else{
            return "$column_type - не должно быть пустым";
        }
        if(is_bool($required)){
            if($required){
                $sql .= " NOT NULL";
            }else{
                if($default!=''){
                    $sql .= " DEFAULT '".$default."'";
                }else{
                    $sql .= " IS NULL";
                }
            }
        }else{
            if($default!=''){
                $sql .= " DEFAULT '".$default."'";
            }else{
                $sql .= " IS NULL";
            }
        }
        if (mysqli_query($this->conn, $sql)) {
            return true;
        } else {
            return "Error add сolumn table: " . mysqli_error($this->conn);
        }
    }

    public function __destruct()
    {
        mysqli_close($this->conn);
    }
}