<?php
include_once "account_management/sessionstart.php";

//calculate postage, returns the value
//reads from the POSTAGE array in config
//is not dependent on any structure of the POSTAGE array
//so POSTAGE can update without this breaking
//except that the highest package weight being 10kg is still here
function calculatePostage($weight, $location = "eu")
{
    $topValue = 0;
    foreach (POSTAGE as $post) {
        if (in_array($weight, $post["range"])) { //if the weight is in the range
            return $post[$location]; //get postage
        }
        $topValue = $post[$location];
        //we record the top value here so that the array can be dynamically 
        //altered without affecting the excess values
    }
    //if postage doesn't fit into range....
    $count = 0;
    while ($weight > 0) { //check how many packages of 10kg are needed to ship the order
        $weight = $weight - 10000;
        $count++;
    }
    //multiply the price of the biggest package by how many would be required
    return ($count * $topValue);
}

//*****************************[PAYMENT VERIFICATION]***************************//

//check if the card number is valid using luhn formula
//details here: https://www.freeformatter.com/credit-card-number-generator-validator.html
function isValidCard($card)
{
    $lastDigit = substr($card, -1); //save the last character to a variable
    $card = rtrim($card, "."); //trim the last character
    $card = strrev($card); //reverse the order of the numbers
    $total = 0;
    foreach ($card as $number) {
        if ($number % 2 !== 0) { //if number is odd
            $number = $number * 2; //multiply by two
        }
        if ($number > 9) { //if number is bigger than 9, subtract 9
            $number = $number - 9;
        }
        $total += $number; //add the processed number to the total
    }
    if ($total % 10 == $lastDigit) { //if total mod 10 is the last digit, is valid
        return true; //is valid
    }
    return false; //is not valid
}

//check if it's a number -- used for card details
//bit pointless since it's just using isNumeric -- try implementing that instead
function isNumber($number)
{
    if (is_numeric($number)) {
        return true;
    } else {
        return false;
    }
}

