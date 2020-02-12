<?php
include "../classes/basket.php";
$basket = new Basket();
$basket->addToBasket($_POST["id"], $_POST["quantity"]);
/*
for testing:
var_dump($_POST["id"]);
var_dump($_POST["quantity"]);
$arr = $basket->getBasket();
var_dump($arr);
var_dump($_COOKIE["basket"]);
//include "../basket_management/destroyBasket.php";
*/
header("Location: http://localhost/RhumaSug/index.php?page=produits"); 

/*
<script>
    window.location.href = "http://localhost/RhumaSug/index.php?page=produits";
</script>
*/
?>