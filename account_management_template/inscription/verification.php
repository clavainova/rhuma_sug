<?php
//doing hash verification
include "sessionstart.php"; //try to start sesison if not already running
include "utilisateur.php"; //user class
require "functions.php"; //functions


print("test");


$email = $_POST["email"];
$hash = $_POST["hash"];
$thisUser = new Utilisateur($email, "", $hash);

$conn = getConnection();


$results = fetchData($pdo);
foreach ($results as $value) {
    if (($value["username"] == $thisUser->getEmail())&&($value["hash"] == $thisUser->getHash())) {
        print("verified");
    }
    else{
        print("partial or incomplete match");
    }
}

//change bool isVerified to true from false on relevant row