<?php
function addToBasket($productId, $quantity)
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
    setcookie('basket', $basket, time() + $expire);
}
