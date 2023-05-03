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
}
