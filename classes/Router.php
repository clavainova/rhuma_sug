<?php

namespace App;

class Router
{

    public function __construct(){
        
    }

    public function getControllerMethod()
    {
        //regain the part of the url before the page
        $route = str_replace('/','',$_SERVER['PATH_INFO']);
        
        if(array_key_exists($route,ROUTES))
        {
            $method = ROUTES[$route];
        }else{
            $method = "page404";
        }
        return $method;
    }
}

?>