<?php
namespace DB;

abstract class RequestDB
{
    private $username="root";
    private $password="root";
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
    public abstract function getTableElements();

    public abstract function searchTableElements();

    public abstract function addTableElements();

    public abstract function updateTableElements();

    public abstract function deleteTableElements();


    protected function __destruct()
    {
        mysqli_close($this->conn);
    }
}