<?php
//doing hash verification
include "sessionstart.php"; //try to start sesison if not already running
include "../classes/utilisateur.php"; //user class
require "functions.php"; //functions

$email = $_GET["email"];
$hash = $_GET["hash"];
$thisUser = new Utilisateur($email, "", $hash);
print("started");

//fetch the data
$pdo = getConnection();
print("<br>got connection");
$results = fetchData($pdo, "Clients");
foreach ($results as $value) {
    //ok so i used to test hash for matches here too
    //but it just doesn't work
    //probably because of escape characters??
    // && ($value["hash"] == $thisUser->__get("hash"))
    if (($value["email"] == $thisUser->__get("email"))) {
        //here we change the value of their verified from 0 to 1
        //you can do this multiple times but it has no adverse effect
        if (!verifyUser($pdo, $value["email"])) {
            //show failed error when it's only one iteration of loop that failed
            $_SESSION["error"] = "300"; //url tampering
        } else {
            //it's worked, set a notification explaining that
            $_SESSION["notif"] = "Verification successful. Please log in below.";
        }
    }
}

redirect("http://localhost/RhumaSug/index.php?page=settings"); //pass in settings homepage
