<?php
//doing hash verification
include "sessionstart.php"; //try to start sesison if not already running
include "../classes/utilisateur.php"; //user class
require "functions.php"; //functions

$email = $_GET["email"];
$hash = $_GET["hash"];
$thisUser = new Utilisateur($email, "", $hash);
$found = false;

if (getConnection()) {
    //fetch the data
    $pdo = getConnection();
    $results = fetchData($pdo, "Clients");
    foreach ($results as $value) {
        if (($value["email"] == $thisUser->__get("email")) && ($value["hash"] == $thisUser->__get("hash"))) {
            //here we change the value of their verified from 0 to 1
            //you can do this multiple times but it has no adverse effect
            if (verifyUser($pdo, $value["email"])) {
                $_SESSION["notif"] = "Verification successful. Please log in below.";
                //it's worked, set a notification explaining that
                $found = true;
                break;
            }
        }
    }
    if (!$found) { //put this at the end with a bool so it doesn't 
        //show failed error when it's only one iteration of loop that failed
        $_SESSION["error"] = "300"; //url tampering
    }
} else {
    $_SESSION["error"] = "200"; //connection to database failed
}

redirect("http://localhost/RhumaSug/index.php?page=settings"); //pass in settings homepage
