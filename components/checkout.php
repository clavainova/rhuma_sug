<?php

require "classes/basket.php";
$basket = new Basket();

if (!$basket->getBasket()) {

    header("Location: http://localhost/RhumaSug/index.php?page=panier");
}
?>

<div class="highlightbox">
    <h3>Are these details correct:</h3>
    <p></p>
</div>