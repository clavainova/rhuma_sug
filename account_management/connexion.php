<?php
//these if/else nestings could use cleaning

include "functions.php";
include "sessionstart.php";
include "../classes/utilisateur.php";

$error = false;

if ((!isset($_POST["email"]) || $_POST["email"] == "") || (!isset($_POST["pass"]) || $_POST["pass"] == "")) {
    $error = 101; //incomplete fields
} else {
    $_SESSION["email"] = $_POST["email"];
    $_SESSION["pass"] = $_POST["pass"];
    //get connection and check tokens match
    $pdo = getConnection();
    $user = fetchSpecificUser($pdo, "email", $_SESSION["email"]);
    if (($user == false)) {
        $error = 102; //user with that email does not exist
    } elseif (passMatch($_SESSION["pass"], $user->__get("hash"))) {
        print("wrong pass");
        $error = 103; //password entered incorrectly"
    } else {
        //login successful
        //add remember me cookie if relevant
        if ($_POST["remember_me"] == '1' || $_POST["remember_me"] == 'on') {
            $hour = time() + 3600 * 24 * 30;
            setcookie('email', $_SESSION["email"], time() + 3600);
            setcookie('password', $_SESSION["pass"], time() + 3600);
        }
        $_SESSION["notif"] = "Login successful.";
    }
}

if ($error) {
    $_SESSION["error"] = $error;
    unset($_SESSION['email']);
    unset($_SESSION['pass']);
}

session_write_close();
redirect("http://localhost/RhumaSug/index.php?page=settings"); //pass in settings homepage
