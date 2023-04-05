<?php

use App\Model\ProductModel;

is_file("../config.php") == true ?
    require_once '../config.php':
    require_once '../../config.php';

// require_once '../../vendor/autoload.php';
require_once ROOT_DIR .'/vendor/autoload.php';

if (isset($_GET['field'])) {
    $word = $_GET['field'];
    $search = new ProductModel;
    $search->catchProductInfos($word);
    // var_dump($word);
}
