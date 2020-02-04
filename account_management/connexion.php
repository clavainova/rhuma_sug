<?php
include "functions.php";
include "sessionstart.php";
include "../classes/utilisateur.php";

//for testing
logout();

if ((!isset($_POST["email"]) || $_POST["email"] == "")
    || (!isset($_POST["pass"]) || $_POST["pass"] == "")
) {
    die("FAILURE no password or no email entered<br>");
} else {
    $_SESSION["email"] = $_POST["email"];
    $_SESSION["pass"] = $_POST["pass"];
    //get connection and check tokens match
    $pdo = getConnection();
    $user = fetchSpecificUser($pdo, "email", $_SESSION["email"]);
    if (($user !== "false")) {
        if ($user->getPassword() == $_SESSION["pass"]) {
            echo "correct";
            //add remember me cookie if relevant
            if ($_POST["remember_me"] == '1' || $_POST["remember_me"] == 'on') {
                $hour = time() + 3600 * 24 * 30;
                setcookie('email', $_SESSION["email"], time() + 3600);
                setcookie('password', $_SESSION["pass"], time() + 3600);
            }
        } else {
            echo "stored password: " . $user->getPassword();
            echo "<br>entered password: " . $_SESSION["pass"];
            echo "<br>password mismatch";
        }
    } else {
        die("user not in table");
    }
}
