<?php
class Utilisateur
{
    private $email;
    private $password;
    //this class used to temporarily store users
    //and also to process queries which will then become users in the database
    //****************************************************** */
    //use polymorphism for complete/incomplete user?? 
    //fetch rest of fields from db directly??
    //compulsory on creation
    public function __construct($mail, $pass)
    {
        //print("initialising, email: " . $mail . "<br>pass: " . $pass);
        $this->email = $mail;
        $this->password = $pass;
        //print("<br>initialising 2, email: " . $this->email . "<br>pass: " . $this->password);
    }
    /*
    //normally part of the constructor
    //getting lots of errors so it goes here for a bit
        $this->hash = $hash;
        $this->nom = $nom;
        $this->prenom = $prenom;
        //optional
        $this->birthday = "";
        $this->phone = "";
        //delivery - added with function
        //not obligatory on creation
        $this->addr1 = "";
        $this->addr2 = "";
        $this->city = "";
        $this->region = "";
        $this->postcode = "";
        $this->country = "";
        //payment details - added with function
        //encapsulated for security
        $this->paymentId = "";
        */

    //for testing, to see if it has values
    function checkValues()
    {
        print("printing values <br>" . var_dump($this->email));
        print("<br>" . var_dump($this->password));
    }

    //ok so this seems like a huge security risk
    //could get hash, username... just about anything.. hmmm
    public function __get($property)
    {
        if (property_exists($this, $property)) {
            return $this->$property;
        }
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function __set($property, $value)
    {
        if (property_exists($this, $property)) {
            $this->$property = $value;
        }
    }

    //not compulsory at time of construction, but these fields are required
    //to order things
    public function addPaymentData()
    {
    }

    public function addPostageData()
    {
    }
}
