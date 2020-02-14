<form class="connexion" action="account_management/addressUpdate.php" method="POST">
    <h1>Address </h1>
    <h1>Information </h1>

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

    <h1>Delivery</h1>
    <h1>Information</h1>
    <b>confirm changes with password :</b>
    <input style="-webkit-text-security: square;" type="text" name="pass" />
    <input type="submit" name="submit" value="soumettre" />
</form>