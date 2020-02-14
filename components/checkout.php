<?php

//need to calculate cumulative price for total section
require "classes/basket.php";
$basket = new Basket();
$items = $basket->getBasket();
require "classes/produit.php";
include "checkout_management/checkoutFunctions.php";
require "checkout_management/verification.php";


//these three are posted
/*
$_POST["postage"];
$_POST["totalPrice"];
$_POST["itemPrice"];
$_POST["quantity"];
*/

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

//if there's a confirmation email, show it
if (isset($_SESSION["notif"])) :
?>
    <div class="notif">
        <?php
        print($_SESSION["notif"]);
        ?>
    </div>
<?php
    unset($_SESSION['notif']);
endif;

//header("Location: http://localhost/RhumaSug/index.php?page=panier");
?>

<div class="highlightbox">
    <h3>Quantity:</h3>
    <p><?php print($_POST["quantity"]); ?></p>
    <h3>Items:</h3>
    <p><?php print($_POST["itemPrice"]."€"); ?></p>
    <h3>Postage (to EU):</h3>
    <p><?php print($_POST["postage"]."€"); ?></p>
    <h3>Total price:</h3>
    <p><?php print($_POST["totalPrice"]); ?></p>
</div>

<h2 class="longtitle">Payment data</h2>
<p class="span-note">(this will only be stored until the transaction is complete, only VISA is accepted)</p>
<form class="connexion" action="account_management/addressUpdate.php" method="POST">
    card number :
    <input type="text" name="cardnum" />
    secruity code :
    <input type="text" name="sc" />
    <b>confirm purchase with password :</b>
    <input type="text" name="pass" />
    <input type="submit" name="submit" value="soumettre" />
</form>