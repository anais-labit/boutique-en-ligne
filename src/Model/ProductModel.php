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
    private int $quantity;



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

    public function setId(int $id) {

        $this->id = $id;
    }

    public function setQuantity(int $quantity) {

        $this->quantity = $quantity;
    }

    public function getQuantity():int {

        return $this->quantity;
    }

    public function setName(string $product) {

        $this->product = $product;
    }

    public function getName():string {

        return $this->product;
    }

    public function setImage(string $image) {

        $this->image = $image;
    }

    public function getImage():string {

        return $this->image;
    }

    public function getWeight():int {

        return $this->weight;
    }

    public function createProduct(
        string $priceType,
        string $product,
        int $cat,
        int $sub_cat,
        string $description,
        string $image,
        string $origin,
        int $weight,
        int $producer,
        int $price
    ) {

        $SQL = new \PDO('mysql:host=localhost;dbname=eShop;charset=utf8', 'root', '');

        //$SQL = new \PDO('mysql:host=localhost;dbname=alexandre-aloesode_todolistjs;charset=utf8', 'Namrod','azertyAZERTY123!');

        $requestCreateProduct = "INSERT INTO products
        (product, id_cat, id_sub_cat, description, image, origin, weight_gr, id_producer, {$priceType}) 
        VALUES (:product, :id_cat, :id_sub_cat, :description, :image, :origin, :weight_gr, :id_producer, :{$priceType})";

        $queryCreateProduct = $SQL->prepare($requestCreateProduct);

        $queryCreateProduct->execute([
            'product' => $product,
            ':id_cat' => $cat,
            ':id_sub_cat' => $sub_cat,
            ':description' => $description,
            ':image' => $image,
            ':origin' => $origin,
            ':weight_gr' => $weight,
            'id_producer' => $producer,
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

    public function createProducer(string $name, string $description, string $image) {

        $SQL = new \PDO('mysql:host=localhost;dbname=eShop;charset=utf8', 'root', '');

        //$SQL = new \PDO('mysql:host=localhost;dbname=alexandre-aloesode_todolistjs;charset=utf8', 'Namrod','azertyAZERTY123!');

        $requestCreateProducer = "INSERT INTO producers (producer, description, image) VALUES (:producer, :description, :image)";

        $queryCreateProducer = $SQL->prepare($requestCreateProducer);

        $queryCreateProducer->execute([
            ':producer' => $name,
            ':description' => $description,
            ':image' => $image
        
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

    public function readOneCategoryProducts(int $id_category):array {

        $SQL = new \PDO('mysql:host=localhost;dbname=eShop;charset=utf8', 'root', '');

        $requestSingleCategoryProducts = "SELECT * FROM products WHERE id_cat = :id_cat";

        $querySingleCategoryProducts = $SQL->prepare($requestSingleCategoryProducts);

        $querySingleCategoryProducts->execute([':id_cat' => $id_category]);

        $resultSingleCategoryProducts = $querySingleCategoryProducts->fetchAll();

        return $resultSingleCategoryProducts;

    }


    public function readOneSubCategoryProducts(int $id_sub_category):array {

        $SQL = new \PDO('mysql:host=localhost;dbname=eShop;charset=utf8', 'root', '');

        $requestSingleSubCategoryProducts = "SELECT * FROM products WHERE id_sub_cat = :id_sub_cat";

        $querySingleSubCategoryProducts = $SQL->prepare($requestSingleSubCategoryProducts);

        $querySingleSubCategoryProducts->execute([':id_sub_cat' => $id_sub_category]);

        $resultSingleSubCategoryProducts = $querySingleSubCategoryProducts->fetchAll();

        return $resultSingleSubCategoryProducts;

    }

    public function readOneCategoryFilters(int $id_category):array {

        $SQL = new \PDO('mysql:host=localhost;dbname=eShop;charset=utf8', 'root', '');

        $requestSingleSubCategoryProducts = "SELECT * FROM sub_categories WHERE id_category = :id_category";

        $querySingleSubCategoryProducts = $SQL->prepare($requestSingleSubCategoryProducts);

        $querySingleSubCategoryProducts->execute([':id_category' => $id_category]);

        $resultSingleSubCategoryProducts = $querySingleSubCategoryProducts->fetchAll();

        return $resultSingleSubCategoryProducts;

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


    public function readAllProducers():array
    {

        $SQL = new \PDO('mysql:host=localhost;dbname=eShop;charset=utf8', 'root', '');

        $requestFetchAllProducers = "SELECT * FROM producers";

        $queryFetchAllProducers = $SQL->prepare($requestFetchAllProducers);

        $queryFetchAllProducers->execute();

        $resultFetchAllProducers = $queryFetchAllProducers->fetchAll();

        return $resultFetchAllProducers;
    }

    public function insertProduct(?int $idUser, ?int $idProduct, ?int $idCart, ?int $quantity) {

        $SQL = new \PDO('mysql:host=localhost;dbname=eShop;charset=utf8', 'root', '');

        $requestFetchAllProducers = "INSERT INTO cart_products (id_user, id_product, id_cart, quantity) VALUES (:id_user, :id_product, :id_cart, :quantity)";

        $queryFetchAllProducers = $SQL->prepare($requestFetchAllProducers);

        $queryFetchAllProducers->execute([
            ':id_user' => $idUser,
            ':id_product' => $idProduct,
            ':id_cart' => $idCart,
            ':quantity' => $quantity
        ]);

        // $resultFetchAllProducers = $queryFetchAllProducers->fetchAll();

        // return $resultFetchAllProducers;

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

        $this->image = $resultSetProductObject[0][5];

        $this->origin = $resultSetProductObject[0][6];

        $this->weight = $resultSetProductObject[0][7];

        $this->producer = $resultSetProductObject[0][8];

        $resultSetProductObject[0][9] !== null?
            $this->priceKg = $resultSetProductObject[0][9]: 
            $this->priceUnit = $resultSetProductObject[0][10];

        return $this;
    }
}