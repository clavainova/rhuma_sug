<?php

//for email sending
include_once 'vendor/autoload.php';
include 'vendor/phpmailer/phpmailer/src/Exception.php';
include 'vendor/phpmailer/phpmailer/src/PHPMailer.php';
include 'vendor/phpmailer/phpmailer/src/SMTP.php';

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
            "clavain",
            "",
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

//fetch the clients table
//returns: associative array containing clients table
function fetchData($pdo, $table)
{
    $stmt = $pdo->prepare("SELECT * FROM " . $table);
    $stmt->execute();
    //fetch results
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $results;
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
            $user = new Utilisateur($value["email"], $value["password"]);
            //for testing:
            //print("<br>values in object when passed<br>");
            //$user->checkValues();
            return $user;
        }
    }
    return false;
}

//************WIP***********************************/
//add a user to the database
//takes one connection and one user object
function addUser($pdo, $user)
{
    ($stmt = "INSERT INTO Clients (email,password,hash) VALUES (?,?,?)");

    if (!$pdo->prepare($stmt)->execute([$user->__get("email"), $user->__get("password"), $user->__get("hash")])) {
        return false;
        //print("preparation failed" . htmlspecialchars($pdo->error));
    } else {
        return true;
    }
}

//takes one $pdo, one user object
//sets the "verification" field to 1 in the database
function verifyUser($pdo, $email){
    ($stmt = "UPDATE `Clients` SET `verified` = '1' WHERE `Clients`.`email` = ? ;");

    if (!$pdo->prepare($stmt)->execute([$email])) {
        return false;
        //print("preparation failed" . htmlspecialchars($pdo->error));
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
    $mail->Username   = "rhuma.sug@gmail.com";
    $mail->Password   = "";

    $mail->IsHTML(true);
    $mail->AddAddress($thisUser->__get("email"), "New Client");
    $mail->SetFrom("rhuma.sug@gmail.com", "Rhuma Sug");
    // $mail->AddReplyTo("clavainova@gmail.com", "reply-to-name");
    // $mail->AddCC("clavainova@gmail.com", "cc-recipient-name");
    $mail->Subject = "Confirmation for your account";
    $content = "Dear customer,<br><br>Thank you for registering with Rhuma Sug with the following personal data.<br>Email: " . $thisUser->__get("email") . "<br>Password: " . $thisUser->__get("password") . "<br><a href='http://localhost/RhumaSug/account_management/verification.php?email=" . $thisUser->__get("email") . "&hash=" . $thisUser->__get("hash") . "'>Click on this link to verify your email.</a>";
    $mail->MsgHTML($content);
    if (!$mail->Send()) {
        return false;
    } else {
        return true;
    }
}

//***********************[MISC]***********************//

//generate a hash code for account verification
//returns hash
function getHash()
{
    return md5(rand(0, 1000));
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

//probably best to combine this with the routing system
function redirect($url)
{
    header("Location: " . $url);
}
?>