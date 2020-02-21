<?php

//for email sending
include_once 'vendor/autoload.php';
include 'vendor/phpmailer/phpmailer/src/Exception.php';
include 'vendor/phpmailer/phpmailer/src/PHPMailer.php';
include 'vendor/phpmailer/phpmailer/src/SMTP.php';


//import the connection data constants from an external file for security
//no github cannot have my personal data!
require '/var/www/html/p_config.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

//***********************[GENERAL VERIFICATION]***********************//

//do the two arguments match? 
//true match (same case) beacuse this is also for case sensitive fields
//returns: bool
function checkMatch($str, $str2)
{
    if ($str == $str2) {
        return true;
    }
    return false;
}

//does it only contain letters, or are there numbers/special characters?
//returns: bool
function isJustLetters($str)
{
    if (!preg_match('/[^A-Za-z0-9]/', $str)) {
        return true;
    }
    return false;
}

//***********************[SPECIFIC VERIFICATION]***********************//

//is the email unique?
//returns: bool
function checkUnique($pdo, $thisUser)
{
    $results = fetchData($pdo, "Clients");
    foreach ($results as $value) {
        if ($value["email"] == $thisUser->__get("email")) {
            return false;
        }
    }
    return true;
}

//is valid email?
//returns: bool
function isEmailValid($email)
{
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return true;
    }
    return false;
}

//is valid password? -- current does not work
//returns: bool
function isPassValid($pass)
{
    // does string contain a capital and a special character w/ regular expressions
    // then check if it's the right length with strlen
    if ((preg_match('/[A-Z]/', $pass))
        && (preg_match('/[^a-zA-Z\d]/', $pass))
        && (strlen($pass) >= 6)
    ) {
        return true;
    }
    return false;
}

//is valid phone number?
//returns: bool
function isPhoneValid($num)
{
    //checks it has 10 digits
    //checks they're all numbers
    if ((strlen($num) == 10) && (is_numeric($num))) {
        return true;
    }
    return false;
}


//***********************[SERVER]***********************//


//get a connection to the server using pdo
//returns: $pdo connection
function getConnection()
{
    //connect to server
    try {
        $pdo = new PDO(
            "mysql:host=localhost;dbname=rhumsug;port=3306",
            constant("dbuser"),
            constant("dbpass"),
            array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION)
        );
        //check server connection, die if fails, return outcome: true if successful
        //print(json_encode(array('outcome' => true)) . "<br>");
    } catch (PDOException $ex) {
        //if connection fails
        $_SESSION["error"] = 200;
        return false;
    }
    return $pdo;
}

//fetch a specific table
//returns: associative array containing the specific table
function fetchData($pdo, $table)
{
    $stmt = $pdo->prepare("SELECT * FROM " . $table);
    $stmt->execute();
    //fetch results
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $results;
}

//fetch a product
//returns the specific product in a produit object or false if it doesn't exist
function fetchSpecificProduct($productid)
{
    $pdo = getConnection();
    $products = fetchData($pdo, "Products");
    foreach ($products as $product) {
        if ($product["product_id"] == $productid) {
            return new Produit($product["product_id"], $product["product_name"], $product["product_description"], $product["unit_price"], $product["unit_weight"], $product["img_url"]);
        }
    }
    return false;
}

//fetch a specific user based on a data point
//returns a new client object
function fetchSpecificUser($pdo, $index, $field)
{
    $users = fetchData($pdo, "Clients");
    foreach ($users as $value) {
        if ($value[$index] == $field) {
            //the values are good but they're not being constructed in the object
            //correctly -- this is the locaion of the error
            return new Utilisateur($value["email"], $value["hash"]);
            //for testing:
            //print("<br>values in object when passed<br>");
            //$user->checkValues();
        }
    }
    return false;
}

//add a user to the database
//takes one connection and one user object
function addUser($pdo, $user)
{
    ($stmt = "INSERT INTO Clients (email,hash) VALUES (?,?)");

    if (!$pdo->prepare($stmt)->execute([$user->__get("email"), $user->__get("hash")])) {
        return false;
        //print("preparation failed" . htmlspecialchars($pdo->error));
    } else {
        return true;
    }
}

//takes one $pdo, one user object
//sets the "verification" field to 1 in the database
function verifyUser($pdo, $email)
{
    ($stmt = "UPDATE `Clients` SET `verified` = '1' WHERE `Clients`.`email` = ? ;");

    if (!$pdo->prepare($stmt)->execute([$email])) {
        return false;
        //print("preparation failed" . htmlspecialchars($pdo->error));
    } else {
        return true;
    }
}

//takes a user, updates their address details
function updateAddress($pdo, $id, $nom, $prenom, $addr1, $ville, $region, $cp, $pays, $phone, $addr2 = "")
{
    //need to update this so it alters an existing one instead of inserting a new one
    ($stmt = "UPDATE Clients
    SET nom = :nom, prenom = :prenom, address1 = :addr1, address2 = :addr2, city = :ville, region = :region, postcode = :cp, country = :pays, phone = :phone
    WHERE `Clients`.`client_id` = :id");
    if (!$pdo->prepare($stmt)->execute(array(
        ":nom" => $nom,
        ":prenom" => $prenom, 
        ":addr1" => $addr1, 
        ":addr2" => $addr2, 
        ":ville" => $ville, 
        ":region" => $region, 
        ":cp" => $cp, 
        ":pays" => $pays, 
        ":phone" => $phone,
        ":id" => $id
        ))) {
        return false;
    } else {
        return true;
    }
}

//send verification email with corresponding hash
function sendEmail($thisUser)
{
    $mail = new PHPMailer();
    $mail->IsSMTP();
    $mail->Mailer = "smtp";

    $mail->SMTPDebug  = 1;
    $mail->SMTPAuth   = TRUE;
    $mail->SMTPSecure = "tls";
    $mail->Port       = 587;
    $mail->Host       = "smtp.gmail.com";
    $mail->Username   = constant("emailuser");
    $mail->Password   = constant("emailpass");

    $mail->IsHTML(true);
    $mail->AddAddress($thisUser->__get("email"), "New Client");
    $mail->SetFrom("rhuma.sug@gmail.com", "Rhuma Sug");
    // $mail->AddReplyTo("clavainova@gmail.com", "reply-to-name");
    // $mail->AddCC("clavainova@gmail.com", "cc-recipient-name");
    $mail->Subject = "Confirmation for your account";
    $content = "Dear customer,<br><br>Thank you for registering with Rhuma Sug with the following personal data.<br>Email: " . $thisUser->__get("email") . "<br><a href='http://localhost/RhumaSug/account_management/verification.php?email=" . $thisUser->__get("email") . "&hash=" . $thisUser->__get("hash") . "'>Click on this link to verify your email.</a>";
    $mail->MsgHTML($content);
    if (!$mail->Send()) {
        return false;
    } else {
        return true;
    }
}

//***********************[MISC]***********************//

//generate a hash code for account verification
//returns hashed password
function getHash($str)
{
    return password_hash($str, PASSWORD_BCRYPT);
}

//checks if the password matches the hash
//returns a boolean
function passMatch($hash, $pass)
{
    return password_verify($pass, $hash);
}

//logout: unset cookies, destroy session
//no return
function logout()
{
    include "sessionstart.php";
    if (isset($_SESSION['email'])) {
        //remove session
        unset($_SESSION['email']);
        unset($_SESSION['pass']);
        session_destroy();
    }
    if (isset($_COOKIE['email'])) {
        //remove all cookies too
        setcookie('email', "");
        setcookie('password', "");
    }
}

//are they logged in?
//probably better if they check the password as well
function verifyLogin()
{
    $pdo = getConnection();

    //start by checking session
    if (isset($_SESSION["email"])) {
        // print("session found: " . $_SESSION["email"]);
        if (fetchSpecificUser($pdo, "email", $_SESSION['email'])) {
            return true;
        }
    }
    //then check cookie
    if (isset($_COOKIE["email"])) {
        if (fetchSpecificUser($pdo, "email", $_COOKIE['email'])) {
            return true;
        }
    }
    //this point reached if no session registered OR current session doesn't match the database
    return false;
}

//returns the current user as a user object
function getCurrentUser()
{
    $pdo = getConnection();
    if(!isset($_SESSION["email"])){
        return fetchSpecificUser($pdo, "email", $_COOKIE["email"]);
    }
    return fetchSpecificUser($pdo, "email", $_SESSION["email"]);
}

//probably best to combine this with the routing system
function redirect($url)
{
    header("Location: " . $url);
}
