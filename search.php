<?php

require_once '../Model/Product.php';

if (isset($_GET['field'])) {
    $word = $_GET['field'];
    $search = new Product();
    $search->catchProductInfos($word);
    var_dump($word);
}

?>
