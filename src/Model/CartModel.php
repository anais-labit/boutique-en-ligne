<?php

namespace App\Model;

use App\Model\Abstract\AbstractModel;

class CartModel extends AbstractModel
{

    public function __construct()
    {
        parent::connect();
        $this->tableName = 'carts';
    }

    public function createCart(int $idUser, int $typeClient)
    {

        $requestCreateCart = "INSERT INTO carts
        (id_user, type_client, date, paid) 
        VALUES (:id_user, :type_client, NOW(), :paid)";

        $queryCreateCart = self::getPdo()->prepare($requestCreateCart);

        $queryCreateCart->execute([
            ':id_user' => $idUser,
            ':type_client' => $typeClient,
            ':paid' => "NO"
        ]);

        //Check si la récup id cart peut se faire dans une autre méthode qu'on appelle ici

    }

    public function getLastCartId(): int
    {

        // $requestGetCartId = "SELECT LAST(id) FROM carts";
        $this->tableName = 'carts';
        return $this->readLast();
        // $requestGetCartId = "SELECT id FROM carts ORDER BY id DESC";


        // $queryGetCartId = self::getPdo()->prepare($requestGetCartId);
        // $queryGetCartId->execute();
        // $resultGetCartId = $queryGetCartId->fetchAll();
        // return $resultGetCartId[0][0];
    }
}
