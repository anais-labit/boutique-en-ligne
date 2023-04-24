<?php

namespace App\Model;

use App\Model\Abstract\AbstractModel;

class CartModel extends AbstractModel {

    public function __construct()
    {
        parent::__construct();
        $this->tableName = 'carts';
        
    }

    public function createCart(int $idUser, int $typeClient) {

        $SQL = new \PDO('mysql:host=localhost;dbname=eShop;charset=utf8', 'root', $this->password);

        //$SQL = new \PDO('mysql:host=localhost;dbname=alexandre-aloesode_todolistjs;charset=utf8', 'Namrod','azertyAZERTY123!');

        $requestCreateCart = "INSERT INTO carts
        (id_user, type_client, date, paid) 
        VALUES (:id_user, :type_client, NOW(), :paid)";

        $queryCreateCart = $SQL->prepare($requestCreateCart);

        $queryCreateCart->execute([
            ':id_user' => $idUser,  
            ':type_client' => $typeClient,
            ':paid' => "NO"
        ]);
//Check si la récup id cart peut se faire dans une autre méthode qu'on appelle ici

        
    }

    public function getLastCartId():int {
        $SQL = new \PDO('mysql:host=localhost;dbname=eShop;charset=utf8', 'root', $this->password);

        // $requestGetCartId = "SELECT LAST(id) FROM carts";
         $requestGetCartId = "SELECT id FROM carts ORDER BY id DESC";


        $queryGetCartId = $SQL->prepare($requestGetCartId);
        $queryGetCartId->execute();
        $resultGetCartId = $queryGetCartId->fetchAll();
        return $resultGetCartId[0][0];
    }
}

?>