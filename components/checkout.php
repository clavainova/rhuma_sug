<?php

require "classes/basket.php";
$basket = new Basket();
require "checkout_management/verification.php";

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
    <h3>Details of the order :</h3>
    <p></p>
</div>