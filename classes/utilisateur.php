<?php
class Utilisateur
{
    //this class used to temporarily store users
    //and also to process queries which will then become users in the database
    //compulsory on creation
    private $email;
    private $password;
    //compulsory on registration, blank by default
    private $hash;
    //compulsory on order
    private $birthday;
    private $phone;
    private $addr1;
    private $city;
    private $region;
    private $postcode;
    private $country;
    private $addr2; //this one's optional

    //payment details here

    public function __construct($mail, $pass, $hash = "")
    {
        //print("initialising, email: " . $mail . "<br>pass: " . $pass);
        $this->email = $mail;
        $this->password = $pass;
        $this->hash = $hash;
        //print("<br>initialising 2, email: " . $this->email . "<br>pass: " . $this->password);
    }

    //not compulsory at time of construction
    public function addPaymentData()
    {
    }

    //not compulsory at time of construction
    public function addPostageData($phone, $addr1, $city, $region, $postcode, $country, $addr2 = "")
    {
        $this->phone = $phone;
        $this->addr1 = $addr1;
        $this->addr2 = $addr2;
        $this->city = $city;
        $this->region = $region;
        $this->postcode = $postcode;
        $this->country = $country;
    }

    //compulsory when buying alcohol
    public function addDOB($birthday)
    {
        $this->birthday = $birthday;
    }

    //ok so this seems like a huge security risk
    //could get hash, username... just about anything.. hmmm
    public function __get($property)
    {
        if (property_exists($this, $property)) {
            return $this->$property;
        }
    }

    public function __set($property, $value)
    {
        if (property_exists($this, $property)) {
            $this->$property = $value;
        }
    }
}
?>