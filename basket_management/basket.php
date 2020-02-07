<?php
include "../classes/basket.php";
$basket = new Basket();

$basket->addToBasket("test", "1");
$arr = $basket->getBasket();
var_dump($arr);
//$basket->destroyBasket();
?>
