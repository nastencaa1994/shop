<?php
namespace DB;

abstract class RequestDB
{
    private $login;
    private $password;
    private $localhost;
    private $nameDB;
    protected $conn;

    protected function __construct()
    {
            $this->conn=mysqli_connect("localhost","root","root","eshop1");
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