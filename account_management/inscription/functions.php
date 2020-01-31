<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

function getConnection()
{
    //connect to server
    try {
        $conn = new PDO(
            "mysql:host=localhost;dbname=php_formulaires;port=3306",
            "clavain",
            "",
            array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION)
        );
        //check server connection, die if fails, return outcome: true if successful
        print(json_encode(array('outcome' => true)) . "<br>");
    } catch (PDOException $ex) {
        //die if connection fails
        die(json_encode(array('outcome' => false, 'message' => 'Unable to connect')));
    }
    return $conn;
}

function checkUnique($pdo, $thisUser)
{
    $results = fetchData($pdo);
    foreach ($results as $value) {
        if ($value["username"] == $thisUser->getEmail()) {
            return false;
        }
    }
    return true;
}

function fetchData($pdo)
{
    $stmt = $pdo->prepare("SELECT * FROM `utilisateurs`");
    $stmt->execute();
    //fetch results
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $results;
    //without argument in brackets, returns parent table
    //var_dump($results);
}

//in function so it's easier to disable for testing
function redirect()
{
    //header("Location: index.php");
}

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
    $mail->Username   = "clavainova@gmail.com";
    $mail->Password   = "";

    $mail->IsHTML(true);
    $mail->AddAddress($thisUser->getEmail(), "recipient-name");
    $mail->SetFrom("clavainova@gmail.com", "from-name");
    // $mail->AddReplyTo("clavainova@gmail.com", "reply-to-name");
    // $mail->AddCC("clavainova@gmail.com", "cc-recipient-name");
    $mail->Subject = "Confirmation for your account";
    $content = "Dear customer,<br><br>Thank you for registering with 5.4_Formulaires_PHP with the following personal data.<br>Email: " . $thisUser->getEmail() . "<br>Password: " . $thisUser->getPassword() . "<br><a href='/var/www/html/progression/5.4_Formulaires_PHP/inscription/verification.php?email=" . $thisUser->email . "&hash=" . $thisUser->hash . "'>Click on this link to verify your email.</a>";
    $mail->MsgHTML($content);
    if (!$mail->Send()) {
        echo "Error while sending Email.";
    } else {
        echo "Email sent successfully";
    }
}
