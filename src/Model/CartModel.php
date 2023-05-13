<?php

namespace App\Model;

use App\Model\Abstract\AbstractModel;
use App\Model\ProductModel;

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

    public function getTotalPrice() {
        $totalPrice = 0;
        foreach ($_SESSION['cart'] as $product) {
            $product->getPriceType() == "kg" ?
                $totalPrice += $product->getPriceKg() * $product->getQuantity():
                $totalPrice += $product->getPriceUnit() * $product->getQuantity();
        }
        return $totalPrice/100;
    }

    public function countCartsByCriteria(string $fieldName, string $fieldValue): int
    {
        $this->tableName = "carts";
        return $this->countByCriteria($fieldName, $fieldValue);
    }

    public function addPaidCartsAmounts(string $fieldName, string $fieldValue): int
    {
        $this->tableName = "carts";
        return $this->addAmounts($fieldName, $fieldValue);
    }
}
