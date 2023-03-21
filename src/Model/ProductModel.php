<?php


class ProductModel
{

    // private ?int $id;

    // private ?string $category;


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
        string $nom,
        int $cat,
        int $sous_cat,
        string $description,
        string $origine,
        float $poids,
        float $price
    ) {

        $SQL = new PDO('mysql:host=localhost;dbname=eShop;charset=utf8', 'root', '');

        //$SQL = new PDO('mysql:host=localhost;dbname=alexandre-aloesode_todolistjs;charset=utf8', 'Namrod','azertyAZERTY123!');

        $requestCreateUser = "INSERT INTO produits
        (nom, cat, sous_cat, description, origine, poids, {$priceType}) 
        VALUES (:nom, :cat, :sous_cat, :description, :origine, :poids, :{$priceType})";

        $queryCreateUser = $SQL->prepare($requestCreateUser);

        $queryCreateUser->execute([
            'nom' => $nom,
            ':cat' => $cat,
            ':souname="productPriceType"s_cat' => $sous_cat,
            ':description' => $description,
            ':origine' => $origine,
            ':poids' => $poids,
            $priceType => $price
        ]);
    }


    public function createCategory(string $category) {

        $SQL = new PDO('mysql:host=localhost;dbname=eShop;charset=utf8', 'root', '');

        //$SQL = new PDO('mysql:host=localhost;dbname=alexandre-aloesode_todolistjs;charset=utf8', 'Namrod','azertyAZERTY123!');

        $requestCreateCategory = "INSERT INTO categories (categorie) VALUES (:categorie)";

        $queryCreateCategory = $SQL->prepare($requestCreateCategory);

        $queryCreateCategory->execute([':categorie' => $category]);

    }


    public function createSubCategory(string $subCategory, int $idCategory) {

        $SQL = new PDO('mysql:host=localhost;dbname=eShop;charset=utf8', 'root', '');

        //$SQL = new PDO('mysql:host=localhost;dbname=alexandre-aloesode_todolistjs;charset=utf8', 'Namrod','azertyAZERTY123!');

        $requestCreateSubCategory = "INSERT INTO sousCategories (sous_categorie, id_categorie) VALUES (:sous_categorie, :id_categorie)";

        $queryCreateSubCategory = $SQL->prepare($requestCreateSubCategory);

        $queryCreateSubCategory->execute([
            ':sous_categorie' => $subCategory,
            'id_categorie' => $idCategory
        ]);

    }

    public function readAllProducts(): array
    {

        $SQL = new PDO('mysql:host=localhost;dbname=eShop;charset=utf8', 'root', '');

        $requestProductsInfos = "SELECT * FROM produits";

        $queryProductsInfos = $SQL->prepare($requestProductsInfos);

        $queryProductsInfos->execute();

        $resultProductsInfos = $queryProductsInfos->fetchAll();

        return $resultProductsInfos;
    }



    public function readOneProduct(string $product): array
    {

        $SQL = new PDO('mysql:host=localhost;dbname=eShop;charset=utf8', 'root', '');

        $requestCheckProduct = "SELECT * FROM produits WHERE nom = :nom";

        $queryCheckProduct = $SQL->prepare($requestCheckProduct);

        $queryCheckProduct->execute([':nom' => $product]);

        $resultCheckProduct = $queryCheckProduct->fetchAll();

        return $resultCheckProduct;
    }


    public function readAllCategories():array
    {

        $SQL = new PDO('mysql:host=localhost;dbname=eShop;charset=utf8', 'root', '');

        $requestFetchAllCategories = "SELECT * FROM categories";

        $queryFetchAllCategories = $SQL->prepare($requestFetchAllCategories);

        $queryFetchAllCategories->execute();

        $resultFetchAllCategories = $queryFetchAllCategories->fetchAll();

        return $resultFetchAllCategories;
    }


    public function readAllSubCategories():array
    {

        $SQL = new PDO('mysql:host=localhost;dbname=eShop;charset=utf8', 'root', '');

        $requestFetchAllSubCategories = "SELECT * FROM sousCategories";

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
        $SQL = new PDO('mysql:host=localhost;dbname=eShop;charset=utf8', 'root', '');
        $req = "SELECT * FROM produits WHERE nom LIKE '$word%'";

        $catchProduct = $SQL->prepare($req);
        $catchProduct->execute();
        $results = $catchProduct->fetchAll(PDO::FETCH_ASSOC);

        // TODO : encode dans le CONTROLLER et non pas le MODEL ?????
        $json = json_encode($results);
        echo $json;
    }
}
