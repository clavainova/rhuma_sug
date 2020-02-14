<?php

define('ROOT', str_replace('/index.php', '', $_SERVER["SCRIPT_NAME"]));

define('ASSETS_PATH', ROOT . "/assets");

define('STYLESHEET_DIR_PATH', ASSETS_PATH . "/css");

define('IMAGES_PATH', ASSETS_PATH . "/img");

//define("SCRIPTS_PATH",ASSETS_PATH."/js");

define('TITLE', 'Rhuma Sug');

define('COMPONENTS', "components");

define('ROUTES', include 'config/routes.php');


//error codes
define('ERRORS', array(
    "101" => "One or more fields incomplete (code:101)",
    "102" => "Account with that email does not exist (code:102)",
    "103" => "Incorrect password (code:103)",
    "104" => "Mismatched tokens - passwords or emails don't match (code:104)",
    "105" => "Name contains illegal characters (code:105)",
    "106" => "Phone format invalid (code:106)",
    "107" => "Password too weak (code:107)",
    "108" => "Email invalid (code:108)",
    "109" => "Email already in use (code:109)",
    "110" => "Did not agree to terms and conditions (code:110)",
    "200" => "Connection with database failed (code:200)",
    "201" => "Failed to write to database (code:201)",
    "202" => "Failed to send confirmation email (code:202)",
    "300" => "Records in the URL did not match the database (code:300)",
    "500" => "Basket empty (code:500)",
    "501" => "You are not logged in, please log in below or create an account (error:501)",
    "502" => "One or more delivery fields incomplete, <a href='http://localhost/RhumaSug/index.php?page=update'>click here to add them</a> (code:502)",
    "503" => "Invalid payment details (code:503)",
    "600" => "Name contains invalid characters (only allowed letters) (code:600)",
    "601" => "Ville or region contains invalid characters (code:601)",
    "602" => "Phone number invalid (code:602)"
));

//postage rates with colissimo international
//in euros -- range is in grams
define('POSTAGE', array(
    array(
        "range" => range(0, 1, 1),
        "eu" => "0.00",
        "international"=> "0.00"
    ),
    array(
        "range" => range(1, 500, 1),
        "eu"=>"12.30",
        "international"=>"24.35"
    ),
    array(
        "range" => range(500, 1000, 1),
        "eu"=>"15.20",
        "international"=>"27.10"
    ),
    array(
        "range" => range(1000, 2000, 1),
        "eu"=>"17.20",
        "international"=>"37.30"
    ),
    array(
        "range" => range(2000, 5000, 1),
        "eu"=>"22.00",
        "international"=>"54.55"
    ),
    array(
        "range" => range(5000, 10000, 1),
        "eu"=>"36.30",
        "international"=>"103.10"
    ),
    array(
        "range" => range(10000, 999999, 1),
        "eu"=>"Need quote",
        "international"=>"Need Quote"
    )
));
