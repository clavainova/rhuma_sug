<?php
//destroy the basket
include "../classes/basket.php";
$basket = new Basket();
$basket->destroyBasket();
//back to the homepage
header("Location: http://localhost/RhumaSug/index.php?page=panier");
