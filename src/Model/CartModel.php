<?php

namespace App\Model;

use App\Model\Abstract\AbstractModel;
use App\Model\ProductModel;

class CartModel extends AbstractModel
{

    public $totalPrice;

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

    public function getCartProducts(int $cartId): array
    {
        $this->tableName = 'cart_products';
        return $this->readOnebyForeignKey('id_cart', $cartId, "void");
    }

    public function readAllCarts(): array
    {
        $this->tableName = "carts";
        return $this->readAll();
    }

    public function readAllUserPaidCarts(string $fieldName, int $value): array
    {
        $this->tableName = "carts";
        return $this->readOnebyForeignKey($fieldName, $value, "date DESC");
    }

    public function countAllCarts(): int
    {
        $this->tableName = "carts";
        return $this->countAll();
    }

    public function getTotalPrice() {
        $this->totalPrice = 0;
        foreach ($_SESSION['cart'] as $product) {
            $product->getPriceType() == "kg" ?
                $this->totalPrice += $product->getPriceKg() * $product->getQuantity():
                $this->totalPrice += $product->getPriceUnit() * $product->getQuantity();
        }
        return $this->totalPrice/100;
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

    public function validateCart(array $params): void
    {
        $this->tableName = "carts";
        $this->updateOne($params);
    }

}
