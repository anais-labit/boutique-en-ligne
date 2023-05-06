<?php

use App\Controller\UpdateController;
use App\Model\ProductModel;
use App\Model\UserModel;


is_file("../config.php") == true ?
    require_once '../config.php' :
    require_once '../../config.php';

// require_once '../../vendor/autoload.php';
require_once ROOT_DIR . '/vendor/autoload.php';



// GESTION DES PRODUITS // 

function displayCategoriesInSelect()
{

    $categories = new ProductModel();
    $displayCategories = $categories->readAllCategories();

    foreach ($displayCategories as $key => $value) {

        echo "
        <option value=" . $value['id'] . ">" . $value["category"] . "</option>";
    }
}


function displaySubCategoriesInSelect()
{

    $subCategories = new ProductModel();

    $displaySubCategories = $subCategories->readAllSubCategories();
    var_dump($displaySubCategories);

    foreach ($displaySubCategories as $key => $value) {

        echo "
        <option value=" . $value['id'] . ">" . $value["sub_category"] . "</option>";
    }
}

function displayProducersInSelect()
{

    $subCategories = new ProductModel();

    $displaySubCategories = $subCategories->readAllProducers();
    var_dump($displaySubCategories);

    foreach ($displaySubCategories as $key => $value) {

        echo "
        <option value=" . $value['id'] . ">" . $value["producer"] . "</option>";
    }
}



if (isset($_POST['addProdButton'])) {

    $newproduct = new ProductModel();

    // $productPriceType = $_POST['productPriceType'];

    $targetDir = "../View/images/products/";
    $targetFile = $targetDir . basename($_FILES['photo']['name']);
    move_uploaded_file($_FILES['photo']['tmp_name'], $targetFile);
    $path = $targetDir . ($_FILES['photo']['name']);

    $newproduct->createOne([
        ':product' => $_POST['productName'],
        ':id_cat' => (int)$_POST['productCat'],
        ':id_sub_cat' => (int)$_POST['productSubCat'],
        ':description' => $_POST['productDesc'],
        ':image' => $path,
        ':origin' => $_POST['productOrigin'],
        ':weight_gr' => (int)$_POST['productWeight'],
        ':id_producer' => (int)$_POST['productProducer'],
        ':' . $_POST['productPriceType'] => (int)$_POST['productPrice']
    ]);
}

if (isset($_POST['addCategoryButton'])) {

    $newproduct = new ProductModel();

    $newproduct->createCategory([':category' => $_POST['categoryName']]);
}

if (isset($_POST['addSubCategoryButton'])) {

    $newproduct = new ProductModel();

    $newproduct->createSubCategory([
        ':sub_category' => $_POST['subCategoryName'],
        ':id_category' => $_POST['subcatCat']
    ]);
}

if (isset($_POST['addProducerButton'])) {

    $newproducer = new ProductModel();

    $targetDir = "../View/assets/images/producers/";
    $targetFile = $targetDir . basename($_FILES['producerPhoto']['name']);
    move_uploaded_file($_FILES['producerPhoto']['tmp_name'], $targetFile);
    $path = $targetDir . ($_FILES['producerPhoto']['name']);

    $newproducer->createProducer([
        ':producer' => $_POST['producerName'],
        ':description' => $_POST['producerDesc'],
        ':image' => $path
    ]);

    // var_dump($_FILES);
}


// GESTION DES UTILISATEURS // 


// function displayAllUsers()
// {

//     $users = new UserModel();

//     $displayUsers = $users->readAllUsers();

//     foreach ($displayUsers as $key => $value) {
//         if ($value['type'] === 1) {
//             $type = "particulier";
//         } else if ($value['type'] === 2) {
//             $type = "entreprise";
//         } else if ($value['type'] === 3) {
//             $type = "collaborateur";
//         } else if ($value['type'] === 4) {
//             $type = "administrateur";
//         }
//         echo "<p> id :" . $value['id'] . " Utilisateur :" . $value['email'] . " rôle : " . $type . "</p>" .
//             "<button type='submit' name='delete-user-button' class='delete-user-button' value='" . $value['id'] . "'>Supprimer</button>";
//     }
// };

function displayAllUsers()
{
    // header("Content-Type: application/json");
    $userModel = new UserModel();

    $users = $userModel->readAllUsers();
    echo json_encode($users);

    // var_dump($users);
}

displayAllUsers();

// supprimer un user
function deleteOneUser()
{

    $userModel = new UserModel();

    if (isset($_POST['delete-user-button'])) {
        $userModel->deleteOne([':id' => $_POST['delete-user-button']]);
        header('Content-Type: application/json');
        echo (json_encode(['success' => 'Le compte a bien été supprimé.']));
    }
}
