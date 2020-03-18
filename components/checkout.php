<?php

if (!verifyLogin()) { //REDIRECT USER IMMEDIATELY IF NOT LOGGED IN
    $_SESSION["error"] = 501;
    header("Location: http://localhost/RhumaSug/index.php?page=panier");
}

if (!isAddressComplete($_SESSION["email"])) : //this function hasn't been written yet
    //$error = 502; //ask for address details? redirect with message?
?>
    <p class="notif">We have no delivery information on file. Please enter it below.</p>
<?php
    include "components/addressForms.php";
else :
?>
    <p class="notif">Recieving address : <a href="http://localhost/RhumaSug/index.php?page=update">(update any changes here)</a></p>
<?php
    printAddress();
//show delivery information, ask if correct, provide link to update it
endif;

//need to calculate cumulative price for total section
$basket = new Basket();
$items = $basket->getBasket();
require "checkout_management/verification.php"; //this includes the address form if necessary
//quickly calculate total 
$totalPrice = $_POST["itemPrice"] + $_POST["postage"];
?>

<h2 class="longtitle">Review order</h2>
<div class="highlightbox">
    <h3>Quantity:</h3>
    <p><?php print($_POST["quantity"]); ?></p>
    <h3>Items:</h3>
    <p><?php print($_POST["itemPrice"] . "€"); ?></p>
    <h3>Postage (to EU):</h3>
    <p><?php print($_POST["postage"] . "€"); ?></p>
    <h3>Total price:</h3>
    <p><?php print($totalPrice . "€"); ?></p>
</div>

<form class="connexion" action="checkout_management/secondaryVerification.php" method="POST">
    <h1>Payment</h1>
    <h1> Data:</h1>
    card number :
    <input type="text" name="cardnum" />
    secruity code :
    <input type="text" name="sc" />
    <b>confirm purchase with password :</b>
    <input type="text" name="pass" />
    <input style="display:none;" type="text" value="<?php print($totalPrice); ?>">
    <input type="submit" name="submit" value="soumettre" />
    <p>(this will only be stored until the transaction is complete, only VISA is accepted)</p>
</form>