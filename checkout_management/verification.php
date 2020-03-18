<?php
//primary verification -- check basket not empty and check logged in
include_once "account_management/sessionstart.php";

$error = false;
//preliminary verification
if (!$basket->getBasket()) {
    $error = 500; //basket is empty
} else if (!verifyLogin()) {
    $error = 501; //not logged in
} 


//finally : 
//$_SESSION["notif"] = "Your order has been placed. You will recieve a confirmation email shortly.";

//send errors to the user
if ($error) {
    $_SESSION["error"] = $error;
    session_write_close();
    //if there's been an error, we redirect to the basket page
    //so they can't just fruitlessly input data
    header("Location: " . "http://localhost/RhumaSug/index.php?page=panier");
}
