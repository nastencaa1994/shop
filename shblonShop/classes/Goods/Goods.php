<?php


namespace classes\Goods;


use classes\DB\RequestDB;

class Goods extends RequestDB
{
    protected $nameTable;

    public function getTableElements()
    {
        return 'getTableElements';
    }

    public function searchTableElements()
    {
        return 'searchTableElements';
    }

    public function addTableElements()
    {
        return 'addTableElements';
    }

    public function updateTableElements()
    {
        return 'updateTableElements';
    }

    public function deleteTableElements()
    {
        return 'deleteTableElements';
    }
}