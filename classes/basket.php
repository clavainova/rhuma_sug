<?php
//this class manages the basket
//it stores data in cookies instead of locally and then interprets that data
class Basket
{
    //searches relevant cookie to find the basket, converts it to an array, 
    //returns array of basket items OR false if it's empty
    public function getBasket()
    {
        //if the basket is empty return false
        if (!isset($_COOKIE["basket"])) {
            return false;
        }
        //assign the cookie to a string variable
        $str = $_COOKIE["basket"];
        //separate the string by its commas (into each item+quantity)
        $arr = explode(",", $str, 99);
        $basket = array(); //create array to store results
        foreach($arr as $value){
            //for each item and quantity, divide by "!" and store in array
            $item = explode("!", $value, 2);
            array_push($basket, $item); //push small array to big array
        }
        return $basket;
    }

    //add something + quantity to the basket
    public function addToBasket($productId, $quantity)
    {
        $expire = time() + 60 * 60 * 24 * 30; // expires in one month
        //if there's nothing in the basket, make the cookie
        if (!isset($_COOKIE["basket"])) {
            setcookie('basket', "", time() + $expire);
        }
        //recuperate the current basket 
        $basket = $_COOKIE["basket"];
        //add the new item
        $basket .= $productId . "!" . $quantity . ",";
        //write changes to cookie
        setcookie('basket', $basket);
    }

    //remove a single item from the array
    public function removeItem($id, $quantity){
        //get the basket as an array
        $items = $this->getBasket();
        //add every item not to be removed to a new array
        $newItems = array();
        foreach($items as $value){
            if(($value[0] == $id)&&($value[1] == $quantity)){ //should it be removed?
            break; //skip this item
            }
            //if you haven't skipped
            array_push($newItems, $value);
        }
        //write the new array (without item removed) to cookies
        $this->writeToCookie($newItems);
    }

    //replace the existing cookie for basket with a new array
    //accepts an array
    public function writeToCookie($arr){
            $arr = implode(("!"||","), $arr, 99); //turns array into string
            $_COOKIE["basket"] = $arr; //stores new string over old cookie
    }

    //sends you to the page that destroys the basket which then instantly redirects you to the homepage
    public function destroyBasket(){
        ?>
        <script>window.location.href = "http://localhost/RhumaSug/basket_management/destroyBasket.php";
        </script>
    <?php    
}
}
?>