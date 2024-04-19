<?php
namespace application\lib;

class Db
{
    private $username="root";
    private $password="";
    private $servername="localhost";
    private $nameDB='TestShop';
    public $conn;

    public function __construct()
    {
        $this->conn=mysqli_connect($this->servername,$this->username,$this->password,$this->nameDB);
        if(! $this->conn){
            die("Connection failed: ".mysqli_connect_error());
        }
        return  $this->conn;
    }


    public function __destruct()
    {
        mysqli_close($this->conn);
    }
}