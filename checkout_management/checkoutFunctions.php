<?php
//calculate postage, returns the value
function calculatePostage($weight, $location = "eu")
{
    $postage = 0;
    foreach(POSTAGE as $post){
        if(in_array($weight, $post["range"])){ //if the weight is in the range
            if($location == "eu"){
                return $post["eu"]; //get eu postage
            }
            else{
                return $post["international"]; //get international postage
            }
        }
    }
    return false; //error has occurred
}
