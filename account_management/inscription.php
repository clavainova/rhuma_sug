<?php
include "../classes/utilisateur.php";
include "sessionstart.php"; //try to start sesison if not already running
require "functions.php"; //functions

$error = false;
$notif = false;

//verification
if ((!isset($_POST["email"]) || $_POST["email"] == "") || (!isset($_POST["pass"]) || $_POST["pass"] == "")) {
    $error = 101; //incomplete fields
} else if ($_POST["agreetc"] == null || $_POST["agreetc"] == 'off') {
    $error = 110; //did not agree to t&c
} else if (($_POST["email"] !== $_POST["emailconfirm"]) || ($_POST["pass"] !== $_POST["passconfirm"])) {
    $error = 104; //mismatched tokens - entered passwords or emails don't match
} elseif (!isEmailValid($_POST["email"]) && !isPassValid($thisUser->$_POST["pass"])) {
    $error = 108; //invalid email or password
} else {
    //done all the offline validation, time to start database-related validation
    $conn = getConnection();     //establish connection to db
    $hash = getHash();           //get a hash
    //make the user object
    $thisUser = new Utilisateur($_POST["email"], $_POST["pass"], $hash);
    if (!checkUnique($conn, $thisUser)) {
        $error = 109; //email already in use
    } else if (!addUser($conn, $thisUser)) {
        $error = 201; //failed to push to database
    } else if (!sendEmail($thisUser)) {
        $error = 202; //sending email failed
    } else {
        $notif = "Successful registration. You will recieve a confirmation email shortly. Click on the link within to complete registraion.";
    }
}

if ($error) {
    $_SESSION["error"] = $error;
} else if ($notif) {
    $_SESSION["notif"] = $notif;
}

redirect("http://localhost/RhumaSug/index.php?page=settings"); //pass in settings homepage
