<!DOCTYPE html>
<html lang="en">
<?php
    include "sessionstart.php";

try {
    //remove session
    unset($_SESSION['username']);
    unset($_SESSION['pass']);
    session_destroy();
} catch (Exception $e) {
    print("logout failed" . $e);
}

?>

<head></head>

<body>
    <form action="inscription.php" method="POST">
        email:
        <input type="text" id="username" name="username" />
        <br>
        mdp:
        <input type="text" id="pass" name="pass" />
        <br>
        le mdp devra comporter au minimum 6 caractères dont au moins 1 majuscule et un caractère spécial.<br>
        <input type="submit" name="submit" value="Submit" />
    </form>
</body>