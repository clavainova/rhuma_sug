<?php


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
    $results = fetchData($pdo);
    foreach ($results as $value) {
        if ($value["email"] == $thisUser->getEmail()) {
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

//is valid password?
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
        $conn = new PDO(
            "mysql:host=localhost;dbname=rhumsug;port=3306",
            "clavain",
            "",
            array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION)
        );
        //check server connection, die if fails, return outcome: true if successful
        //print(json_encode(array('outcome' => true)) . "<br>");
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

//fetch a specific user based on a data point
//returns a new client object
function fetchSpecificUser($pdo, $index, $field)
{
    $users = fetchData($pdo);
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

//add a user to the database
//currently lacking several required arguments -- incomplete
function addUser($conn, $user, $pass)
{
    if ($stmt = $conn->prepare('INSERT INTO Clients (nom,password) VALUES (?,?)')) {
        //preparing statement bind param
        $stmt->bind_param('ss', $user, $pass);
        //statements bound,executing statement
        $stmt->execute();
        //executed statement
        // sendEmail($email);
    } else {
        die("preparation failed" . htmlspecialchars($conn->error));
    }
}

//send verification email with corresponding hash
//not integrated rn
/*
function sendVerificationEmail($thisUser){
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
*/

//***********************[MISC]***********************//

//generate a hash code for account verification
//returns hash
function getHash()
{
    return md5(rand(0, 1000));
}

//logout: unset cookies, destroy session, redirect to index
//no return
function logout()
{
    try {
        //remove session
        unset($_SESSION['email']);
        unset($_SESSION['pass']);
        session_destroy();
        //remove all cookies too
        setcookie('email', "");
        setcookie('password', "");
    } catch (Exception $e) {
        print("logout failed" . $e);
    }
}

//are they logged in?
//currently doen't support cookies
function verifyLogin()
{
    $pdo = getConnection();
    if ((!isset($_SESSION["email"])) && (!isset($_COOKIE["email"]))) {
        return false;
    } else if (!fetchSpecificUser($pdo, "email", $_SESSION['email'])) {
        return false;
    } else if (!fetchSpecificUser($pdo, "email", $_COOKIE['email'])) {
        return false;
    }
    return true;
}

function redirect()
{
?>
    <script type="text/javascript">
        window.location.href = "http://localhost/RhumaSug/index.php?page=settings";
    </script>
<?php
}
