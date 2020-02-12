<?php
class Produit
{

    private $id;
    private $name;
    private $desc;
    private $price;
    private $weight;
    private $img_url;

    public function __construct($id, $name, $desc, $price, $weight, $img_url)
    {
        $this->id = $id;
        $this->name = $name;
        $this->desc = $desc;
        $this->price = $price;
        $this->weight = $weight;
        $this->img_url = $img_url;
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
