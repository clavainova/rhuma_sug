<?php
class Order
{
    private $customerId; //customer_id
    private $date; //order_date
    private $cardNo; //card_number
    private $code; //security_code
    //others in db are id, sent and paid, to be determined another way

    public function __construct()
    {

    }

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
