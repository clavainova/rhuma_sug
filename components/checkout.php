<?php


//need to calculate cumulative price for total section
require "classes/basket.php";
$basket = new Basket();
$items = $basket->getBasket();
require "classes/produit.php";
include "checkout_management/checkoutFunctions.php";
require "checkout_management/verification.php"; //this includes the address form if necessary

$totalPrice = $_POST["itemPrice"] + $_POST["postage"];
//quickly calculate total 
?>

<h2 class="longtitle">Review order</h2>
<div class="highlightbox">
    <h3>Quantity:</h3>
    <p><?php print($_POST["quantity"]); ?></p>
    <h3>Items:</h3>
    <p><?php print($_POST["itemPrice"]."€"); ?></p>
    <h3>Postage (to EU):</h3>
    <p><?php print($_POST["postage"]."€"); ?></p>
    <h3>Total price:</h3>
    <p><?php print($totalPrice."€"); ?></p>
</div>

<form class="connexion" action="account_management/addressUpdate.php" method="POST">
<h1>Payment</h1><h1> Data:</h1>    
card number :
    <input type="text" name="cardnum" />
    secruity code :
    <input type="text" name="sc" />
    <b>confirm purchase with password :</b>
    <input type="text" name="pass" />
    <input type="submit" name="submit" value="soumettre" />
    <p>(this will only be stored until the transaction is complete, only VISA is accepted)</p>
</form>
