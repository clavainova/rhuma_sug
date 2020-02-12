<?php
include "../classes/basket.php";
$basket = new Basket();
$basket->removeItem($_POST["id"], $_POST["quantity"]);
header("Location: http://localhost/RhumaSug/index.php?page=panier"); 