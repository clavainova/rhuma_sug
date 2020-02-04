

<?php
include "../classes/utilisateur.php";

//doing hash verification


include "sessionstart.php"; //try to start sesison if not already running
include "../classes/utilisateur.php"; //user class
require "functions.php"; //functions
//for email sending
require_once 'vendor/autoload.php';
require 'vendor/phpmailer/phpmailer/src/Exception.php';
require 'vendor/phpmailer/phpmailer/src/PHPMailer.php';
require 'vendor/phpmailer/phpmailer/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


//check user and pass are set
if ((!isset($_POST["email"]) || $_POST["email"] == "") || (!isset($_POST["pass"]) || $_POST["pass"] == "")) {
    //if nothing entered or fields incomplete, redirect back to the login page
    print("nothing entered/fields incomplete");
} else {
    $_SESSION["email"] = $_POST["email"];
    $_SESSION["pass"] = $_POST["pass"];
    $hash = md5( rand(0,1000) );
    $thisUser = new Utilisateur($_SESSION["email"], $_SESSION["pass"], $hash);
    print ("session variables set. <br><b>user:</b> ") . $_SESSION["email"] . "<br><b>pass:</b> " . $_SESSION["pass"] . "<br>";
    //now we know that they exist, check if valid
    if ($thisUser->isEmailValid() && $thisUser->isPassValid()) {
        print("validated<br>");
        //if valid establish connection to db
        $conn = getConnection();
        if (checkUnique($conn, $thisUser)) {
            print("email unique");
            if ($thisUser->addDb($conn)) {
                print("success, finished");
                //now send them an email
                sendEmail($thisUser);
            } else {
                print("failed to push to database");
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