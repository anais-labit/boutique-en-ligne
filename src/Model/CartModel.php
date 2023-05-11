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

    public function getLastCartId(): int
    {
        $this->tableName = 'carts';
        return $this->readLast();
    }

    public function readAllCarts(): array
    {
        $this->tableName = "carts";
        return $this->readAll();
    }

    public function countAllCarts(): int
    {
        $this->tableName = "carts";
        return $this->countAll();
    }

    public function countCartsByCriteria(string $fieldName, string $fieldValue): int
    {
        $this->tableName = "carts";
        return $this->countByCriteria($fieldName, $fieldValue);
    }
}
