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

//display errors and confirmation messages
//if there's an error, show it
if (isset($_SESSION["error"])) :
?>
    <div class="error">
        <?php
        print(ERRORS[$_SESSION["error"]]);
        ?>
    </div>
<?php
    //unset error
    unset($_SESSION['error']);
endif;
//header("Location: http://localhost/RhumaSug/index.php?page=panier");
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
