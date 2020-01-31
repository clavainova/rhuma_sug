login successful!<br>
<?php
if (isset($_SESSION["username"])) :
?>
    user: <?php print($_SESSION['username']); ?><br>
    pass: <?php print($_SESSION['pass']);
        elseif (isset($_COOKIE["username"])) : ?>
    user: <?php print($COOKIE['username']); ?><br>
    pass: <?php print($_COOKIE['pass']);
        else :
            print("Error, log out and try again");
        endif; ?>

<form action="logout.php" method="post">
    logout : <input type="submit" />
</form>