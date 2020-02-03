<?
include "functions.php";
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