<?php

//***********************[GENERAL VERIFICATION]***********************//

//do the two arguments match? true match - same case
//returns: bool
function checkMatch($str, $str2)
{
if($str == $str2){
    return true;
}
return false;
}

//does it only contain letters, or are there numbers/special characters?
//returns: bool
function isJustLetters($str)
{
if(!preg_match('/[^A-Za-z0-9]/', $str))
{
    return true;
}
return false;
}

//***********************[SPECIFIC VERIFICATION]***********************//


//is valid email?
//returns: bool
function isEmailValid($email)
{
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return true;
    }
    return false;
}

//is the email unique?
//returns: bool
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

//is valid password?
//returns: bool
function isPassValid($pass)
{
    // does string contain a capital and a special character w/ regular expressions
    // then check if it's the right length with strlen
    if ((preg_match('/[A-Z]/', $password))
        && (preg_match('/[^a-zA-Z\d]/', $>password))
        && (strlen($password) >= 6)
    ) {
        return true;
    }
    return false;
}

//is valid phone number?
//returns: bool
function verifyPhone($num)
{
}

//is valid password?
//returns: bool
function verifyPassword($pass)
{
}


//***********************[SERVER]***********************//


//get a connection to the server using pdo
//returns: $pdo connection
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

//fetch the clients table
//returns: associative array containing clients table
function fetchData($pdo)
{
    $stmt = $pdo->prepare("SELECT * FROM `Clients`");
    $stmt->execute();
    //fetch results
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $results;
    //without argument in brackets, returns parent table
    //var_dump($results);
}