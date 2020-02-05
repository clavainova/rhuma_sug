<?php

define('ROOT',str_replace('/index.php','',$_SERVER["SCRIPT_NAME"]));

define('ASSETS_PATH',ROOT."/assets");

define('STYLESHEET_DIR_PATH',ASSETS_PATH."/css");

define('IMAGES_PATH',ASSETS_PATH."/img");

//define("SCRIPTS_PATH",ASSETS_PATH."/js");

define('TITLE','Rhuma Sug');

define('COMPONENTS',"components");

define('ROUTES',include 'config/routes.php');
?>