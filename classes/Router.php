<?php

namespace App;

class Router
{

    public function __construct(){
        
    }

    public function getControllerMethod()
    {
        //regain the part of the url after index.php
        //$thisurl = $this->getUrl(); 
        $route = str_replace('/','', $_GET["page"]);
        //print("searching for array key: " . $route);
        if(array_key_exists($route,ROUTES))
        {
            $method = ROUTES[$route];
            // print("found");
            // var_dump($method);
        }else{
            $method = "404";
        }
        return $method;
    }

    //get path info from url
    //currently unused
    public static function get__PATH_INFO($path){
        $path_elements = explode("/", $path);
        $tempPI = "";
        if (isset($path_elements[2])){
            for ($i = 2 ;$i < count($path_elements); $i++ )
                $tempPI .= "/".$path_elements[$i];
        }
        return $tempPI;
    }

    //get url
    //currently unused
    public static function getUrl(){
        if(isset($_SERVER['HTTPS']) &&  
            $_SERVER['HTTPS'] === 'on') 
        {$link = "https"; }
        else
        {$link = "http";} 
    $link .= "://";
    $link .= $_SERVER['HTTP_HOST'];
    $link .= $_SERVER['PHP_SELF'];
    return $link; 
    }
}
?>