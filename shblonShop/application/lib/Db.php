<?php

namespace application\lib;

class Db
{
    private $username = "root";
    private $password = "";
    private $servername = "localhost";
    private $nameDB = 'TestShop';
    protected $conn;

    public function __construct()
    {
        $this->conn = mysqli_connect($this->servername, $this->username, $this->password, $this->nameDB);
        if (!$this->conn) {
            die("Connection failed: " . mysqli_connect_error());
        }
        return $this->conn;
    }

    /**
     * //        $column[]=[
     * //            'column_name'=>'name',-------* обязательно
     * //            'column_type'=>'VARCHAR(30)',-------* обязательно
     * //            'required'=>true,
     * //            'primary_key'=>true,
     * //            'auto_increment'=>true,
     * //            'default'=>''
     * //        ];
     */

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
            print_r($sql);
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
                $sql .= "and " . $key . " " . $item;
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
            echo "Table " . $nameTable . "  drop row";
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
            $sql = chop($sql, ",");
        } else {
            $sql .= "*";
        }

        $sql .= " FROM" . $nameTable . " WHERE 1=1 ";

        if(!empty($where)){
            foreach ($where as $item){
                $sql .=  "and ". $item ;
            }
        }
        $result = mysqli_query($this->conn, $sql);
        return $result;
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
        print_r($sql);
        if (mysqli_query($this->conn, $sql)) {
            echo "Table " . $nameTable . "  INSERT row";
        } else {
            echo "Error INSERT table: " . mysqli_error($this->conn);
        }
    }


    public function requestDB($sql){
        $ret=[];
        $result = mysqli_query($this->conn, $sql);
        if( $result === false ) {
            print_r($sql);
            return ( print_r( mysqli_errors(), true));
        }
        while($row = mysqli_fetch_array($result, MYSQLI_NUM)) {
            $ret['Items'][] = $row;
        }
        if (array_key_exists('Items', $ret)) {
            $ret['Total'] = count($ret['Items']);
        }
        else {
            $ret['Total'] = 0;
        }
        return $ret;


        $result = mysqli_query($this->conn, $request);
        return $result;
    }

    public function __destruct()
    {
        $this->conn->close();
    }
}