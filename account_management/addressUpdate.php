<?php
include "functions.php";
include "../classes/utilisateur.php";
include "sessionstart.php";

$offlineuser = getCurrentUser();
$user = "";
$pdo = getConnection();
$error = false;

//$id, $nom, $prenom, $addr1, $ville, $region, $cp, $pays, $phone, $addr2

if (!$offlineuser) { //can we fetch the logged in user?
    $error = 203; //couldn't fetch relevant users
}
//are any of the compulsory fields incomplete?
else if ((!isset($_POST["nom"]) || $_POST["nom"] == "") ||
    (!isset($_POST["prenom"]) || $_POST["prenom"] == "") ||
    (!isset($_POST["addr1"]) || $_POST["addr1"] == "") ||
    (!isset($_POST["ville"]) || $_POST["ville"] == "") ||
    (!isset($_POST["region"]) || $_POST["region"] == "") ||
    (!isset($_POST["cp"]) || $_POST["cp"] == "") ||
    (!isset($_POST["country"]) || $_POST["country"] == "") ||
    (!isset($_POST["phone"]) || $_POST["phone"] == "")
) {
    $error = 101; //one or more required fields incomplete
} else if (!isPhoneValid($_POST["phone"])) {
    $error = 602; //phone invalid
} else if (!isJustLetters($_POST["nom"]) || !isJustLetters($_POST["prenom"])) {
    $error = 600; //name contains illegal characters
} else if (!isJustLetters($_POST["ville"]) || !isJustLetters($_POST["region"])) {
    $error = 601; //ville and/or region contain illegal characters
} else if (!(passMatch($_POST["pass"], $offlineuser->__get("hash")))) {
    print($user->__get("hash"));
    print($_POST["pass"]);
    $error = 103; //password entered incorrectly
} else { //if passes preliminary verification
    $user = fetchSpecificUser($pdo, "email", $offlineuser->__get("email"));
    if (updateAddress(
        $pdo,
        $user->__get("id"),
        $_POST["nom"],
        $_POST["prenom"],
        $_POST["addr1"],
        $_POST["ville"],
        $_POST["region"],
        $_POST["cp"],
        $_POST["country"],
        $_POST["phone"]
    )) {
        $_SESSION["notif"] = "Address updated successfully.";
    } else {
        $error = 201; //failed to push to database
    }
}

if ($error) {
    $_SESSION["error"] = $error;
}

session_write_close();

redirect("http://localhost/RhumaSug/index.php?page=update"); //pass in settings homepage
