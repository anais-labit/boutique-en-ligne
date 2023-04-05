<?php
namespace App\Model;


class ProductModel
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



    public function __construct()
    {
    }


    // public function setId(int $id)
    // {

    //     $this->id = $id;
    // }

    // public function getId(): int
    // {

    //     return $this->id;
    // }


    public function createProduct(
        string $priceType,
        string $product,
        int $cat,
        int $sub_cat,
        string $description,
        string $origin,
        int $weight,
        int $price
    ) {

        $SQL = new \PDO('mysql:host=localhost;dbname=eShop;charset=utf8', 'root', '');

        //$SQL = new \PDO('mysql:host=localhost;dbname=alexandre-aloesode_todolistjs;charset=utf8', 'Namrod','azertyAZERTY123!');

        $requestCreateProduct = "INSERT INTO products
        (product, id_cat, id_sub_cat, description, origin, weight, {$priceType}) 
        VALUES (:product, :id_cat, :id_sub_cat, :description, :origin, :weight, :{$priceType})";

        $queryCreateProduct = $SQL->prepare($requestCreateProduct);

        $queryCreateProduct->execute([
            'product' => $product,
            ':id_cat' => $cat,
            ':id_sub_cat' => $sub_cat,
            ':description' => $description,
            ':origin' => $origin,
            ':weight' => $weight,
            $priceType => $price
        ]);
    }


    public function createCategory(string $category) {

        $SQL = new \PDO('mysql:host=localhost;dbname=eShop;charset=utf8', 'root', '');

        //$SQL = new \PDO('mysql:host=localhost;dbname=alexandre-aloesode_todolistjs;charset=utf8', 'Namrod','azertyAZERTY123!');

        $requestCreateCategory = "INSERT INTO categories (category) VALUES (:category)";

        $queryCreateCategory = $SQL->prepare($requestCreateCategory);

        $queryCreateCategory->execute([':category' => $category]);

    }


    public function createSubCategory(string $subCategory, int $idCategory) {

        $SQL = new \PDO('mysql:host=localhost;dbname=eShop;charset=utf8', 'root', '');

        //$SQL = new \PDO('mysql:host=localhost;dbname=alexandre-aloesode_todolistjs;charset=utf8', 'Namrod','azertyAZERTY123!');

        $requestCreateSubCategory = "INSERT INTO sub_categories (sub_category, id_category) VALUES (:sub_category, :id_category)";

        $queryCreateSubCategory = $SQL->prepare($requestCreateSubCategory);

        $queryCreateSubCategory->execute([
            ':sub_category' => $subCategory,
            'id_category' => $idCategory
        ]);

    }

    public function readAllProducts(): array
    {

        $SQL = new \PDO('mysql:host=localhost;dbname=eShop;charset=utf8', 'root', '');

        $requestProductsInfos = "SELECT * FROM products";

        $queryProductsInfos = $SQL->prepare($requestProductsInfos);

        $queryProductsInfos->execute();

        $resultProductsInfos = $queryProductsInfos->fetchAll();

        return $resultProductsInfos;
    }



    public function readOneProduct(string $product): array
    {

        $SQL = new \PDO('mysql:host=localhost;dbname=eShop;charset=utf8', 'root', '');

        $requestCheckProduct = "SELECT * FROM products WHERE product = :product";

        $queryCheckProduct = $SQL->prepare($requestCheckProduct);

        $queryCheckProduct->execute([':product' => $product]);

        $resultCheckProduct = $queryCheckProduct->fetchAll();

        return $resultCheckProduct;
    }


    public function readAllCategories():array
    {

        $SQL = new \PDO('mysql:host=localhost;dbname=eShop;charset=utf8', 'root', '');

        $requestFetchAllCategories = "SELECT * FROM categories";

        $queryFetchAllCategories = $SQL->prepare($requestFetchAllCategories);

        $queryFetchAllCategories->execute();

        $resultFetchAllCategories = $queryFetchAllCategories->fetchAll();

        return $resultFetchAllCategories;
    }


    public function readAllSubCategories():array
    {

        $SQL = new \PDO('mysql:host=localhost;dbname=eShop;charset=utf8', 'root', '');

        $requestFetchAllSubCategories = "SELECT * FROM sub_categories";

        $queryFetchAllSubCategories = $SQL->prepare($requestFetchAllSubCategories);

        $queryFetchAllSubCategories->execute();

        $resultFetchAllSubCategories = $queryFetchAllSubCategories->fetchAll();

        return $resultFetchAllSubCategories;
    }



    public function updateProduct()
    {
    }


    public function deleteProduct()
    {
    }

    public function catchProductInfos($word)
    {
        $SQL = new \PDO('mysql:host=localhost;dbname=eShop;charset=utf8', 'root', '');
        $req = "SELECT * FROM products WHERE product LIKE '$word%'";

        $catchProduct = $SQL->prepare($req);
        $catchProduct->execute();
        $results = $catchProduct->fetchAll(\PDO::FETCH_ASSOC);

        // TODO : encode dans le CONTROLLER et non pas le MODEL ?????
        $json = json_encode($results);
        echo $json;
    }

    public function setObject(int $id):object {

        $SQL = new \PDO('mysql:host=localhost;dbname=eShop;charset=utf8', 'root', '');

        $requestSetProductObject = "SELECT * FROM products WHERE id = :id";

        $querySetProductObject = $SQL->prepare($requestSetProductObject);

        $querySetProductObject->execute([":id" => $id]);

        $resultSetProductObject = $querySetProductObject->fetchAll();

        $this->id = $resultSetProductObject[0][0];

        $this->product = $resultSetProductObject[0][1];

        $this->cat = $resultSetProductObject[0][2];

        $this->subCat = $resultSetProductObject[0][3];

        $this->description = $resultSetProductObject[0][4];

        // $this->image = $resultSetProductObject[0][5];

        $this->origin = $resultSetProductObject[0][6];

        $this->weight = $resultSetProductObject[0][7];

        // $this->producer = $resultSetProductObject[0][8];
        $resultSetProductObject[0][9] !== null?
            $this->priceKg = $resultSetProductObject[0][9]: 
            $this->priceUnit = $resultSetProductObject[0][10];

        return $this;
    }
}