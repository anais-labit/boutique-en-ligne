<?php

namespace App\Model\Abstract;

abstract class AbstractModel {

    protected string $tableName;

    public function __construct()
    {
        
    }

    public function readAll():array {

        $SQL = new \PDO('mysql:host=localhost;dbname=eShop;charset=utf8', 'root', '');

        $requestReadAll = "SELECT * FROM $this->tableName";

        $queryReadAll = $SQL->prepare($requestReadAll);

        $queryReadAll->execute();

        $resultReadAll = $queryReadAll->fetchAll();

        return $resultReadAll;
    }
}

?>