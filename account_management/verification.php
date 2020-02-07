<?php
//doing hash verification
include "sessionstart.php"; //try to start sesison if not already running
include "../classes/utilisateur.php"; //user class
require "functions.php"; //functions

$email = $_GET["email"];
$hash = $_GET["hash"];
$thisUser = new Utilisateur($email, "", $hash);

$pdo = getConnection();

$results = fetchData($pdo, "Clients");
foreach ($results as $value) {
    if (($value["email"] == $thisUser->__get("email"))&&($value["hash"] == $thisUser->__get("hash"))) {
        //here we change the value of their verified from 0 to 1
        $_SESSION["notif"] = "Verification successful. Please log in below.";
    }
    else{
        $_SESSION["error"] = "300";
    }
}

redirect("http://localhost/RhumaSug/index.php?page=settings"); //pass in settings homepage

//change bool isVerified to true from false on relevant row