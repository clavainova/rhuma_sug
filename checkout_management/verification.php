<?php
$error = false;
if (!$basket->getBasket()) {
    $error = 500; //basket is empty
} else if (!verifyLogin()) {
    $error = 501; //not logged in
}
//check address is complete - if not, error 502
//check payment details are complete, if not error 503

//create order (object)
//push order to database
//subtract items ordered from available stock
//connect order to user (update user object with FK)
//send verification email

//finally : 
//$_SESSION["notif"] = "Your order has been placed. You will recieve a confirmation email shortly.";

//send errors or confirmation to the user
if ($error) {
    $_SESSION["error"] = $error;
    unset($_SESSION['email']);
    unset($_SESSION['pass']);
}
