<?php
include "sessionstart.php";
if ((!isset($_POST["username"]) || $_POST["username"] == "") || (!isset($_POST["pass"]) || $_POST["pass"] == "")) {
    die("FAILURE no password or no username entered<br>");
} else {
    $_SESSION["username"] = $_POST["username"];
    $_SESSION["pass"] = $_POST["pass"];
    //get connection and upload to db
    $conn = getConnection();
    uploadUser($conn, $_SESSION["username"], $_SESSION["pass"]);
    //add remember me cookie if relevant
    if ($_POST["remember_me"] == '1' || $_POST["remember_me"] == 'on') { {
            $hour = time() + 3600 * 24 * 30;
            setcookie('username', $_SESSION["username"], time() + 3600);
            setcookie('password', $_SESSION["pass"], time() + 3600);
        }
    }
}

function verify($conn){
    $stmt = $conn->prepare('SELECT * FROM `utilisateurs` WHERE  username,password');
}

function getConnection()
{
    $servername = "localhost";
    $username = "clavain";
    $password = "";
    $database = "rhumaslug";
    //connect to server
    $conn = new mysqli($servername, $username, $password, $database);
    if ($conn->connect_error) {
        die("Connection failed"); // . $conn->connect_error
    }
    return $conn;
}

function uploadUser($conn, $user, $pass)
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

//pure php alternative: header("Location: index.php");
?>
<script type="text/javascript">
    window.location.href = "index.php";
</script>