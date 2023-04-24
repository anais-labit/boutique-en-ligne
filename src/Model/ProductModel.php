<?php

namespace App\Model;

use App\Model\Abstract\AbstractModel;


class ProductModel extends AbstractModel
{

    private int $id;
    private string $product;
    private int $cat;
    private int $subCat;
    private string $description;
    private string $image;
    private string $origin;
    private int $weight;
    private int $producer;
    private int $priceKg;
    private int $priceUnit;
    private int $quantity;
    // private string $tableName = 'products';



    public function __construct()
    {
        parent::__construct();
        $this->tableName = 'products';
    }


    public function getId()
    {

        return $this->id;
    }

    public function setId(int $id)
    {

        $this->id = $id;
    }

    public function setQuantity(int $quantity)
    {

        $this->quantity = $quantity;
    }

    public function getQuantity(): int
    {

        return $this->quantity;
    }

    public function setName(string $product)
    {

        $this->product = $product;
    }

    public function getName(): string
    {

        return $this->product;
    }

    public function setImage(string $image)
    {

        $this->image = $image;
    }

    public function getImage(): string
    {

        return $this->image;
    }

    public function getWeight(): int
    {

        return $this->weight;
    }


    public function createCategory(array $params)
    {

        $this->tableName = "categories";

        $this->createOne($params);
    }


    public function createSubCategory(array $params)
    {

        $this->tableName = "sub_categories";

        $this->createOne($params);
    }

    public function createProducer(array $params)
    {

        $this->tableName = "producers";

        $this->createOne($params);
    }

    public function readOneCategoryFilters(int $id_category): array
    {

        $this->tableName = "sub_categories";

        return $this->readOnebyForeignKey('id_category', $id_category);
    }


    public function readAllCategories(): array
    {

        $this->tableName = "categories";

        return $this->readAll();
    }


    public function readAllSubCategories(): array
    {

        $this->tableName = "sub_categories";

        return $this->readAll();
    }


    public function readAllProducers(): array
    {

        $this->tableName = "producers";

        return $this->readAll();
    }

    public function addToCart(?int $idUser, ?int $idProduct, ?int $idCart, ?int $quantity)
    {

        $this->tableName = 'cart_products';

        $this->createOne([
            ':id_user' => $idUser,
            ':id_product' => $idProduct,
            ':id_cart' => $idCart,
            ':quantity' => $quantity
        ]);
    }




    public function updateProduct()
    {
    }


    public function deleteFromCart(int $idProduct, int $idCart)
    {
        $SQL = new \PDO('mysql:host=localhost;dbname=eShop;charset=utf8', 'root', $this->password);
        $requestDeleteOne = "DELETE FROM cart_products
        WHERE  id_product = :id_product
        AND id_cart = :id_cart
        ";

        $queryDeleteOne = $SQL->prepare($requestDeleteOne);

        $queryDeleteOne->execute([
            ":id_product" => $idProduct,
            ":id_cart" => $idCart
        ]);
        // $this->tableName = 'cart_products';

        // $this->deleteOneInForeignTable($params);

    }

    public function catchProductInfos($word)
    {
        $SQL = new \PDO('mysql:host=localhost;dbname=eShop;charset=utf8', 'root', $this->password);
        $req = "SELECT * FROM products WHERE product LIKE '$word%'";

        $catchProduct = $SQL->prepare($req);
        $catchProduct->execute();
        $results = $catchProduct->fetchAll(\PDO::FETCH_ASSOC);

        // TODO : encode dans le CONTROLLER et non pas le MODEL ?????
        $json = json_encode($results);
        echo $json;
    }

    public function setObject(int $id): object
    {

        $SQL = new \PDO('mysql:host=localhost;dbname=eShop;charset=utf8', 'root', $this->password);

        $requestSetProductObject = "SELECT * FROM products WHERE id = :id";

        $querySetProductObject = $SQL->prepare($requestSetProductObject);

        $querySetProductObject->execute([":id" => $id]);

        $resultSetProductObject = $querySetProductObject->fetchAll();

        $this->id = $resultSetProductObject[0][0];

        $this->product = $resultSetProductObject[0][1];

        $this->cat = $resultSetProductObject[0][2];

        $this->subCat = $resultSetProductObject[0][3];

        $this->description = $resultSetProductObject[0][4];

        $this->image = $resultSetProductObject[0][5];

        $this->origin = $resultSetProductObject[0][6];

        $this->weight = $resultSetProductObject[0][7];

        $this->producer = $resultSetProductObject[0][8];

        $resultSetProductObject[0][9] !== null ?
            $this->priceKg = $resultSetProductObject[0][9] :
            $this->priceUnit = $resultSetProductObject[0][10];

        return $this;
    }
}
