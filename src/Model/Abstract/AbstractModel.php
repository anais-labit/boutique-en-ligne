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


    public function readOnebyId(int $id):array {

        $SQL = new \PDO('mysql:host=localhost;dbname=eShop;charset=utf8', 'root', '');

        $requestReadOne = "SELECT * FROM $this->tableName WHERE id = :id";

        $queryReadOne = $SQL->prepare($requestReadOne);

        $queryReadOne->execute(['id' => $id]);

        $resultReadOne = $queryReadOne->fetchAll();

        return $resultReadOne;
    }


    public function readOnebyString(string $input, string $fieldName):array {
        
        $SQL = new \PDO('mysql:host=localhost;dbname=eShop;charset=utf8', 'root', '');
        
        $requestReadOne = "SELECT * FROM $this->tableName WHERE $fieldName = :$fieldName";
        
        $queryReadOne = $SQL->prepare($requestReadOne);
        
        $queryReadOne->execute([$fieldName => $input]);
        
        $resultReadOne = $queryReadOne->fetchAll();
        
        return $resultReadOne;
    }
    
    public function readOnebyForeignKey(string $foreignKey, int $keyValue):array {

        $SQL = new \PDO('mysql:host=localhost;dbname=eShop;charset=utf8', 'root', '');

        $requestReadOne = "SELECT * FROM $this->tableName WHERE $foreignKey = :$foreignKey";

        $queryReadOne = $SQL->prepare($requestReadOne);

        $queryReadOne->execute([':' . $foreignKey => $keyValue]);

        $resultReadOne = $queryReadOne->fetchAll();

        return $resultReadOne;
    }

    
    public function createOne(array $params) {

        $fieldsName = implode(', ', array_keys($params));
        $fieldsName = str_replace(':', '', $fieldsName);

        $fieldsSqlValue = implode(', ', array_keys($params));

        $SQL = new \PDO('mysql:host=localhost;dbname=eShop;charset=utf8', 'root', '');

        //$SQL = new \PDO('mysql:host=localhost;dbname=alexandre-aloesode_todolistjs;charset=utf8', 'Namrod','azertyAZERTY123!');

        $requestCreateOne = "INSERT INTO $this->tableName ($fieldsName) VALUES ($fieldsSqlValue)";

        $queryCreateOne = $SQL->prepare($requestCreateOne);

        $queryCreateOne->execute($params);
    }
}

?>