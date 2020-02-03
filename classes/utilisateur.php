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

    public function getHash()
    {
        return $this->hash;
    }

    //this seems like a security risk
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
}
