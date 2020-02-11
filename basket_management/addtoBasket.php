<?php
include "../classes/basket.php";
$basket = new Basket();

//right now these are not being passed
var_dump($_POST["id"]);
var_dump($_POST["quantity"]);

$basket->addToBasket($_POST["id"], $_POST["quantity"]);
$arr = $basket->getBasket();
var_dump($arr);

//$basket->destroyBasket();
