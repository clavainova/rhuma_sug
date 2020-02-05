<?php
include "functions.php";
include "sessionstart.php";
include "../classes/utilisateur.php";

$error = false; //this is where we store the error code if there is one
//should probably return it and display it somehow

if ((!isset($_POST["email"]) || $_POST["email"] == "")
    || (!isset($_POST["pass"]) || $_POST["pass"] == "")
) {
    $error = 101; //incomplete fields
} else {
    $_SESSION["email"] = $_POST["email"];
    $_SESSION["pass"] = $_POST["pass"];
    //get connection and check tokens match
    $pdo = getConnection();
    $user = fetchSpecificUser($pdo, "email", $_SESSION["email"]);
    if (($user !== "false")) {
        if ($user->getPassword() == $_SESSION["pass"]) {
            //login successful
            //add remember me cookie if relevant
            if ($_POST["remember_me"] == '1' || $_POST["remember_me"] == 'on') {
                $hour = time() + 3600 * 24 * 30;
                setcookie('email', $_SESSION["email"], time() + 3600);
                setcookie('password', $_SESSION["pass"], time() + 3600);
            }
            //it's finished, was successful
            session_write_close();
        } else {
            $error = 103; //password entered incorrectly"
        }
    } else {
        $error = 102; //user with that email does not exist
    }
}


if(!$error){
    print("data stored in session, email: " . $_SESSION["email"] . " pass: " . $_SESSION["pass"]);
}
else{
    print("error: " . $error);
    //return error somehow and display it
}

redirect(""); //pass in settings homepage
