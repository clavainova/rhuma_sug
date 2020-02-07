<?php

define('ROOT',str_replace('/index.php','',$_SERVER["SCRIPT_NAME"]));

define('ASSETS_PATH',ROOT."/assets");

define('STYLESHEET_DIR_PATH',ASSETS_PATH."/css");

define('IMAGES_PATH',ASSETS_PATH."/img");

//define("SCRIPTS_PATH",ASSETS_PATH."/js");

define('TITLE','Rhuma Sug');

define('COMPONENTS',"components");

define('ROUTES',include 'config/routes.php');


//error codes
define('ERRORS', array(
    "200"=>"Connection with database failed (code:200)",
    "201"=>"Failed to write to database (code:201)",
    "202"=>"Failed to send confirmation email (code:202)",
    "101"=>"One or more fields incomplete (code:101)",
    "102"=>"Account with that email does not exist (code:102)",
    "103"=>"Password entered incorrectly (code:103)",
    "104"=>"Passwords don't match (code:104)",
    "105"=>"Name contains illegal characters (code:105)",
    "106"=>"Phone format invalid (code:106)",
    "107"=>"Password too weak (code:107)",
    "108"=>"Email invalid (code:108)",
    "109"=>"Email already in use (code:109)"
));
