<?php
include_once "account_management/sessionstart.php";
$error = false;


//gotta keep authenticating all this basic stuff for security
if (!verifyLogin()) {
    $error = 501; //not logged in
} else if (!isAddressComplete()) {
    $error = 502; //no address on record
}
//check payment details

//create order (object)
//push order to database
//subtract items ordered from available stock
//connect order to user (update user object with FK)
//send verification email

if ($error) {
    $_SESSION["error"] = $error;
    session_write_close();
}
