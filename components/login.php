    <h2>Connexion</h2>
    <form action="account_management/connexion.php" method="POST">
        email :
        <input type="text" id="email" name="email" />
        password :
        <input type="text" id="pass" name="pass" />
        stay connected :
        <input type="checkbox" id="remember_me" name="remember_me" />
        <input type="submit" name="submit" value="Submit" />
    </form>

    <h2>S'inscrire</h2>
    <form action="account_management/inscription.php" method="POST">
        email :
        <input type="text" id="email" name="email" />
        confirmez email :
        <input type="text" id="emailconfirm" name="emailconfirm" />
        password :
        <input type="text" id="pass" name="pass" />
        confirmez password :
        <input type="text" id="passconfirm" name="passconfirm" />
        <input type="checkbox" id="agreetc" name="agreetc" />
        J'accepte les termes et conditions de RhumaSug
        <input type="submit" name="submit" value="soumettre" />
        <p>Tous les champs sont obligatoires pour acheter de l'alcool. Date de naissance non requise pour l'achat de sucre.
</p>
    </form>