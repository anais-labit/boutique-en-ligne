<?php

namespace App\Model\Abstract;

abstract class AbstractModel
{

    protected string $tableName;

    protected ?string $password = null;

    protected static $pdo;

    public function __construct()
    {
        
    }

    public static function connect()
    {
        $password = (PHP_OS == 'Linux') ? '' : 'root';
        $dsn = 'mysql:host=localhost;dbname=eShop;charset=utf8';
        self::$pdo = new \PDO($dsn, 'root', $password);
    }

    protected static function getPdo()
    {
        if (!self::$pdo){
            self::connect();

        } 
        // self::$pdo = new \PDO($dsn, 'root', $password);
        return self::$pdo;
    }



    public function createOne(array $params)
    {

        $fieldsName = implode(', ', array_keys($params));
        $fieldsName = str_replace(':', '', $fieldsName);

        $fieldsSqlValue = implode(', ', array_keys($params));

        // self::getPdo() = new \PDO('mysql:host=localhost;dbname=eShop;charset=utf8', 'root', $this->password);

        //self::getPdo() = new \PDO('mysql:host=localhost;dbname=alexandre-aloesode_todolistjs;charset=utf8', 'Namrod','azertyAZERTY123!');

        $requestCreateOne = "INSERT INTO $this->tableName ($fieldsName) VALUES ($fieldsSqlValue)";

        $queryCreateOne = self::getPdo()->prepare($requestCreateOne);

        $queryCreateOne->execute($params);
    }

    public function readAll(): array
    {


        // self::getPdo() = new \PDO('mysql:host=localhost;dbname=eShop;charset=utf8', 'root', $this->password);

        $requestReadAll = "SELECT * FROM $this->tableName";

        $queryReadAll = self::getPdo()->prepare($requestReadAll);

        $queryReadAll->execute();

        $resultReadAll = $queryReadAll->fetchAll();

        return $resultReadAll;
    }


    public function readOnebyId(int $id): array
    {

        // self::getPdo() = new \PDO('mysql:host=localhost;dbname=eShop;charset=utf8', 'root', $this->password);

        $requestReadOne = "SELECT * FROM $this->tableName WHERE id = :id";

        $queryReadOne = self::getPdo()->prepare($requestReadOne);

        $queryReadOne->execute(['id' => $id]);

        $resultReadOne = $queryReadOne->fetchAll();

        return $resultReadOne;
    }


    public function readOnebyString(string $input, string $fieldName): array
    {

        // self::getPdo() = new \PDO('mysql:host=localhost;dbname=eShop;charset=utf8', 'root', $this->password);

        $requestReadOne = "SELECT * FROM $this->tableName WHERE $fieldName = :$fieldName";

        $queryReadOne = self::getPdo()->prepare($requestReadOne);

        $queryReadOne->execute([$fieldName => $input]);

        $resultReadOne = $queryReadOne->fetchAll();

        return $resultReadOne;
    }

    public function readOnebyForeignKey(string $foreignKey, int $keyValue): array
    {

        // self::getPdo() = new \PDO('mysql:host=localhost;dbname=eShop;charset=utf8', 'root', $this->password);

        $requestReadOne = "SELECT * FROM $this->tableName WHERE $foreignKey = :$foreignKey";

        $queryReadOne = self::getPdo()->prepare($requestReadOne);

        $queryReadOne->execute([':' . $foreignKey => $keyValue]);

        $resultReadOne = $queryReadOne->fetchAll();

        return $resultReadOne;
    }

    public function readLast(): int
    {

        // self::getPdo() = new \PDO('mysql:host=localhost;dbname=eShop;charset=utf8', 'root', $this->password);

        $requestReadLast = "SELECT id FROM $this->tableName ORDER BY id DESC LIMIT 1";

        $queryReadLast = self::getPdo()->prepare($requestReadLast);

        $queryReadLast->execute();

        $resultReadLast = $queryReadLast->fetchAll();

        return $resultReadLast[0][0];
    }


    public function updateOne(array $params)
    {

        //Récupération des params puis suppression du dernier élément du tableau, à savoir l'id, qu'on ne veut pas update
        $fieldsToUpdate = $params;
        array_pop($fieldsToUpdate);

        //Création du tableau dans lequel stocker notre string de requête d'update
        $requestString = [];

        //Boucle pour alimenter notre tableau
        foreach ($fieldsToUpdate as $key => $value) {

            $fieldName = str_replace(':', '', $key);
            $requestString[] = $fieldName . ' = ' . $key;
        }

        //Conversion du tableau en string
        $requestString = implode(', ', $requestString);


        // self::getPdo() = new \PDO('mysql:host=localhost;dbname=eShop;charset=utf8', 'root', $this->password);

        //self::getPdo() = new \PDO('mysql:host=localhost;dbname=alexandre-aloesode_todolistjs;charset=utf8', 'Namrod','azertyAZERTY123!');

        $requestUpdateOne = "UPDATE $this->tableName SET $requestString WHERE id = :id";

        $queryUpdateOne = self::getPdo()->prepare($requestUpdateOne);

        $queryUpdateOne->execute($params);
    }

    public function deleteOne(array $params) {
        $fieldsArray = [];

        foreach($params as $key=>$value) {
            $fieldsArray[] = $key;
        }

        $input1 = $fieldsArray[0];
        $fieldName1 = str_replace(':', '', $input1);

        if(count($fieldsArray) > 1) {

            $input2 = $fieldsArray[1];
            $fieldName2 = str_replace(':', '', $input2);
            $requestDeleteOne = "DELETE FROM $this->tableName WHERE $fieldName1 = $input1 AND $fieldName2 = $input2";
        }

        else {
        
            $requestDeleteOne = "DELETE FROM $this->tableName WHERE $fieldName1 = $input1";
        }

        $queryDeleteOne = self::getPdo()->prepare($requestDeleteOne);

        $queryDeleteOne->execute($params);
    }

}
