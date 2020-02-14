<?php
include "functions.php";

//$id, $nom, $prenom, $addr1, $ville, $region, $cp, $pays, $phone, $addr2

//are any of the compulsory fields incomplete?
if ((!isset($_POST["nom"]) || $_POST["nom"] == "") || 
(!isset($_POST["prenom"]) || $_POST["prenom"] == "") ||
(!isset($_POST["addr1"]) || $_POST["addr1"] == "") || 
(!isset($_POST["ville"]) || $_POST["ville"] == "") || 
(!isset($_POST["region"]) || $_POST["region"] == "") || 
(!isset($_POST["cp"]) || $_POST["cp"] == "") || 
(!isset($_POST["country"]) || $_POST["country"] == "") || 
(!isset($_POST["phone"]) || $_POST["phone"] == "")) {
    $error = 101; //one or more required fields incomplete
}
else if(!isPhoneValid($_POST["phone"])){
    $error = 602; //phone invalid
}
else if(!isJustLetters($_POST["nom"]) || !isJustLetters($_POST["prenom"])){
    $error = 600; //name contains illegal characters
}
else if(!isJustLetters($_POST["ville"])||!isJustLetters($_POST["region"])){
    $error = 601; //ville and/or region contain illegal characters
}
else{ //if passes preliminary verification
    $pdo = getConnection();
    $user = fetchSpecificUser($pdo, "password", $_SESSION["password"]);
    updateAddress($pdo, $user->__get("id"), $_POST["nom"],$_POST["prenom"],$_POST["addr1"],$_POST["ville"],$_POST["region"],$_POST["cp"],$_POST["country"],$_POST["phone"]);
}

if ($error) {
    $_SESSION["error"] = $error;
}

//redirect("http://localhost/RhumaSug/index.php?page=update"); //pass in settings homepage