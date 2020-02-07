<?php
include "../classes/utilisateur.php";
include "sessionstart.php"; //try to start sesison if not already running
require "functions.php"; //functions

//check user and pass are set
if ((!isset($_POST["email"]) || $_POST["email"] == "") || (!isset($_POST["pass"]) || $_POST["pass"] == "")) {
    //if nothing entered or fields incomplete, redirect back to the login page
    $error = 101; //incomplete fields
} else {
    $_SESSION["email"] = $_POST["email"];
    $_SESSION["pass"] = $_POST["pass"];
    $hash = getHash();
    $thisUser = new Utilisateur($_SESSION["email"], $_SESSION["pass"], $hash);
    print ("session variables set. <br><b>user:</b> ") . $_SESSION["email"] . "<br><b>pass:</b> " . $_SESSION["pass"] . "<br>";
    //now we know that they exist, check if valid
    if (isEmailValid($thisUser->__get("email")) && isPassValid($thisUser->__get("password"))) {
        print("validated<br>");
        //if valid establish connection to db
        $conn = getConnection();
        if (checkUnique($conn, $thisUser)) {
            print("email unique");
            if (addUser($conn, $thisUser)) {
                //now send them an email
                if (sendEmail($thisUser)) {
                    $notif = "Successful registration. You will recieve a confirlation email shortly.";
                } else {
                    $error = 202; //sending email failed
                }
            } else {
                $error = 201; //failed to push to database
            }
        } else {
            print("email taken");
        }
    } else {
        print("validation failed");
        //if validation fails, return to login page
        // - display message here?
    }
}

if ($error) {
    $_SESSION["error"] = $error;
} else if($notif){
    $_SESSION["notif"] = $notif;
}

redirect("http://localhost/RhumaSug/index.php?page=settings"); //pass in settings homepage
