<?php
include_once "account_management/sessionstart.php";

$error = false;
//preliminary verification
if (!$basket->getBasket()) {
    $error = 500; //basket is empty -- error not displaying

} else if (!verifyLogin()) {
    $error = 501; //not logged in -- error not displaying
} else { //passed preliminary verification
    //which address forms are required?
    if (!isAddressComplete($_SESSION["email"])) : //this function hasn't been written yet
        $error = 502; //ask for address details? redirect with message?
?>
        <p class="notif">We have no delivery information on file. Please enter it below.</p>
<?php
        include "components/addressForms.php";
    else :
    //show delivery information, ask if correct, provide link to update it
    endif;
}



//finally : 
//$_SESSION["notif"] = "Your order has been placed. You will recieve a confirmation email shortly.";

//send errors or confirmation to the user
if ($error) {
    $_SESSION["error"] = $error;
    session_write_close();
    //if there's been an error, we redirect to the basket page
    //so they can't just fruitlessly input data
    header("Location: " . "http://localhost/RhumaSug/index.php?page=panier");
}
