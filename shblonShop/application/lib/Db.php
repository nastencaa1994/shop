<?php
namespace application\lib;

class Db
{
    private $username="root";
    private $password="";
    private $servername="localhost";
    private $nameDB='TestShop';
    protected $conn;

    protected function __construct()
    {
        $this->conn=mysqli_connect($this->servername,$this->username,$this->password,$this->nameDB);
        if(! $this->conn){
            die("Connection failed: ".mysqli_connect_error());
        }
        return  $this->conn;
    }

    protected function addTable($nameTable,$column=[]){
//        $column[]=[
//            'column_name'=>'name',
//            'column_type'=>'VARCHAR(30)',
//            'required'=>true,
//            'primary_key'=>true,
//            'auto_increment'=>true,
//            'default'=>''
//        ];
        $primaryKeyCheck = true;
        $autoIncrementCheck = true;
        $sql="CREATE TABLE IF NOT EXISTS ".$nameTable." (";
        foreach ($column as $index=>$items){

            $sql.=$items["column_name"]." ".$items["column_type"]." DEFAULT(FALSE) NOT NULL";
            if(isset($items["default"])){
                $sql.=" DEFAULT(".$items["default"].")";
            }
            if(isset($items["required"]) && $items["required"]){
                $sql.=" NOT NULL";
            }
            if($autoIncrementCheck && $primaryKeyCheck){
                if(isset($items["primary_key"]) && $items["primary_key"] === true){
                    if($primaryKeyCheck){
                        $primaryKeyCheck = false;
                        $sql.=" PRIMARY KEY";
                    }else{
                        die('Error - primary_key - only in one column');
                    }
                }
                if(isset($items["auto_increment"]) && $items["auto_increment"] === true){
                    if($autoIncrementCheck){
                        $primaryKeyCheck = false;
                        $sql.=" AUTO_INCREMENT";
                    }else{
                        die('Error - auto_increment - only in one column');
                    }
                }
            }


            if($index+1!=count($column)){
                $sql.=",";
            }
        }
        $sql.=")";
        if (mysqli_query($this->conn, $sql)) {
            echo "Table ".$nameTable." created successfully";
        } else {
            echo "Error creating table: " . mysqli_error($this->conn);
        }
    }

    protected function deleteRowTable($nameTable,$where=[]){
        $sql = "DELETE FROM ".$nameTable;
        if(!empty($where)){
            $sql .=" WHERE 1=1 ";
            foreach ($where as $key=>$item){
                $sql .="and ".$key." ".$item;
            }
        }
        if (mysqli_query($this->conn, $sql)) {
            echo "Table ".$nameTable."  delete row";
        } else {
            echo "Error delete table: " . mysqli_error($this->conn);
        }
    }
//дописать addInRowTable
    protected function addInRowTable($nameTable,$values){
        $sql = " INSERT INTO ".$nameTable."(";

        foreach ($values as $index=>$valueItems){
            if ($index==0){
                foreach ($valueItems as $key=>$item){
                    $sql .=$key.", ";
                }
                $sql =  chop($sql,",");
                $sql .=") VALUES ";
            }
//дописать addInRowTable вот тут
        }


    }

    protected function __destruct()
    {
        $this->conn->close();
    }
}