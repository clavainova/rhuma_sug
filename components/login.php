    <h2>Connexion</h2>
    <form class="connexion" action="account_management/connexion.php" method="POST">
        email :
        <input type="text" id="email" name="email" />
        password :
        <input type="password" id="pass" name="pass" />
        stay connected :
        <input type="checkbox" id="remember_me" name="remember_me" />
        <input type="submit" name="submit" value="Submit" />
    </form>

    <h2>S'inscrire</h2>
    <form class="connexion" action="account_management/inscription.php" method="POST">
        email :
        <input type="text" id="email" name="email" />
        confirmez email :
        <input type="text" id="emailconfirm" name="emailconfirm" />
        password :
        <input type="password" id="pass" name="pass" />
        confirmez password :
        <input type="password" id="passconfirm" name="passconfirm" />
        <input type="checkbox" id="agreetc" name="agreetc" />
        J'accepte les termes et conditions de RhumaSug
        <input type="submit" name="submit" value="soumettre" />
        <br>
    </form>