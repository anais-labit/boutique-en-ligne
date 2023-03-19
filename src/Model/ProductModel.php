<?php


class ProductModel
{

    // public ?PDO $SQL; 

    // = new PDO('mysql:host=localhost;dbname=EshopPACA;charset=utf8', 'root','');
    private ?int $id;

    private ?string $category;


    public function __construct()
    {
    }


    public function setId(int $id)
    {

        $this->id = $id;
    }

    public function getId(): int
    {

        return $this->id;
    }




    public function createProduct(
        string $nom,
        int $cat,
        int $sous_cat,
        string $description,
        string $origine,
        float $poids
    ) {

        $SQL = new PDO('mysql:host=localhost;dbname=eShop;charset=utf8', 'root', '');

        //$SQL = new PDO('mysql:host=localhost;dbname=alexandre-aloesode_todolistjs;charset=utf8', 'Namrod','azertyAZERTY123!');

        $request_create_user = "INSERT INTO produits
        (nom, cat, sous_cat, description, origine, poids) 
        VALUES (:nom, :cat, :sous_cat, :description, :origine, :poids)";

        $query_create_user = $SQL->prepare($request_create_user);

        $query_create_user->execute(array(
            'nom' => $nom,
            ':cat' => $cat,
            ':sous_cat' => $sous_cat,
            ':description' => $description,
            ':origine' => $origine,
            ':poids' => $poids,
        ));
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



    public function readOneProduct(string $email): array
    {

        $SQL = new PDO('mysql:host=localhost;dbname=eShop;charset=utf8', 'root', '');

        $requestCheckEmail = "SELECT * FROM produits WHERE email = :email";

        $queryCheckEmail = $SQL->prepare($requestCheckEmail);

        $queryCheckEmail->execute(['email' => $email]);

        $resultCheckEmail = $queryCheckEmail->fetchAll();

        return $resultCheckEmail;
    }


    public function readAllCategories()
    {

        $SQL = new PDO('mysql:host=localhost;dbname=eShop;charset=utf8', 'root', '');

        $requestFetchAllCategories = "SELECT * FROM categories";

        $queryFetchAllCategories = $SQL->prepare($requestFetchAllCategories);

        $queryFetchAllCategories->execute();

        $resultFetchAllCategories = $queryFetchAllCategories->fetchAll();

        // $this->id = $resultFetchAllCategories[0][0];

        // $this->category = $resultFetchAllCategories[0][1];

        // return $this;

        return $resultFetchAllCategories;
    }


    public function readAllSubCategories()
    {

        $SQL = new PDO('mysql:host=localhost;dbname=eShop;charset=utf8', 'root', '');

        $requestFetchAllSubCategories = "SELECT * FROM sousCategories";

        $queryFetchAllSubCategories = $SQL->prepare($requestFetchAllSubCategories);

        $queryFetchAllSubCategories->execute();

        $resultFetchAllSubCategories = $queryFetchAllSubCategories->fetchAll();

        // $this->id = $resultFetchAllSubCategories[0][0];

        // $this->category = $resultFetchAllSubCategories[0][1];

        // return $this;

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
