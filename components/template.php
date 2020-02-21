<!DOCTYPE html>
<html lang="fr">

<?php
//functions/classes needed for site to function
include_once "account_management/functions.php";
include_once "account_management/sessionstart.php";
include_once "classes/utilisateur.php";
include_once "classes/produit.php";
include_once "classes/basket.php";
include_once "checkout_management/checkoutFunctions.php";
include_once COMPONENTS . '/head.php'; //here's the css, title, etc
?>

<body>
    <?php
    include_once COMPONENTS . '/header.php'; //banner image
    include_once COMPONENTS . '/nav.php'; //navbar
    include_once "config/displayNotification.php"; //displays notifications if they exist
    include_once COMPONENTS . '/' . $template; //add the template for the page
    include_once COMPONENTS . '/footer.php'; //footer
    ?>
</body>

</html>