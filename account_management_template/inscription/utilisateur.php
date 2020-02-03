<?php
class Utilisateur
{
    function __construct($email, $password, $hash)
    {
        $this->email = $email;
        $this->password = $password;
        $this->hash = $hash;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getHash(){
        return $this->hash;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function setPassword($pass)
    {
        $this->password = $pass;
    }

    public function isEmailValid()
    {
        if (filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            return true;
        }
        return false;
    }

    public function isPassValid()
    {
        // does string contain a capital and a special character w/ regular expressions
        // then check if it's the right length with strlen
        if ((preg_match('/[A-Z]/', $this->password))
            && (preg_match('/[^a-zA-Z\d]/', $this->password))
            && (strlen($this->password) >= 6)
        ) {
            return true;
        }
        return false;
    }

    public function addDb($pdo)
    {
        try {
            ($stmt = "INSERT INTO utilisateurs (username,password,hash) VALUES (?,?,?)");
            $pdo->prepare($stmt)->execute([$this->email, $this->password, $this->hash]);
            return true;
        } catch (Exception $e) {
            return false;
        }
    }
}
