<?php
//payment verification -- is valid? 
//and address verification -- is entered
//then confirmation

include "../account_management/sessionstart.php";
include "../account_management/functions.php";
include "../classes/utilisateur.php";
include "../classes/basket.php";
include "checkoutFunctions.php";

//fetch the current user
$error = false;
$pdo = getConnection();
$user = fetchSpecificUser($pdo, "email", $_SESSION["email"]);

//***address verification***//
//have they entered an address?
if (!isAddressComplete($_SESSION["email"])) {
    $error = 502; //no address on record
}
//***payment verification***//
//check if fields are empty
else if (!(isset($_POST["cardnum"]) && isset($_POST["sc"]) && isset($_POST["pass"]))) {
    $error = 101; //incomplete fields
}
//check if the password is correct
else if (!passMatch($_POST["pass"], $user->__get("hash"))) {
    $error = 103; //password entered incorrectly"
}
//is the card number valid
else if (!isValidCard($_POST["cardnum"])) {
    $error = 511; //card number invalid
}
//is the security code formatted correctly
else if (!isValidCode($_POST["sc"])) {
    $error = 512; //security code is not formatted correctly
}
//if all verification is successful...
else {
    //get an array with the contents of the basket
    $basket = new Basket();
    $items = $basket->getBasket();
    var_dump($items);
    //make each order
    foreach ($items as $order) {
        var_dump($order);
        handleOrder($pdo, $user->__get("id"), $order[0], $order[1], $_POST["sc"], $_POST["cardnum"]);
    }
}


print($error);
//send errors to the user
if ($error) {
    $_SESSION["error"] = $error;
    session_write_close();
    //if there's been an error, we redirect to the previous page
    //header("Location: " . "http://localhost/RhumaSug/index.php?page=checkout");
}
