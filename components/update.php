<button class="back-button" onclick="window.location.href = 'http://localhost/RhumaSug/index.php?page=settings'">BACK</button>

<?php
include "account_management/sessionstart.php";

//if the last thing had an error, display it
if (isset($_SESSION["error"])) :
?>
    <div class="error">
        <?php
        print(ERRORS[$_SESSION["error"]]);
        ?>
    </div>
<?php
    //unset error
    unset($_SESSION['error']);
endif;
?>

<h2 class="longtitle">Update your personal details</h2>
<form class="connexion" action="account_management/addressUpdate.php" method="POST">
    <h1>Delivery </h1>
    <h1>information</h1>
    nom :
    <input type="text" name="nom" />
    prenom :
    <input type="text" name="prenom" />
    adresse 1 :
    <input type="text" name="addr1" />
    adresse 2 (optional) :
    <input type="text" name="addr2" />
    ville :
    <input type="text" name="ville" />
    region :
    <input type="text" name="region" />
    code postale :
    <input type="text" name="cp" />
    pays :
    <?php include("components/countries.php"); ?>
    téléphone :
    <input type="text" name="phone" />

    <h1>Payment </h1>
    <h1>information</h1>
    <b>confirm changes with password :</b>
    <input type="text" name="pass" />
    <input type="submit" name="submit" value="soumettre" />
</form>