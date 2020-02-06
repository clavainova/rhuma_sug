<?php

namespace App;

class Kernel
{
    private $request;
    private $router;
    private $controller;

    public function __construct()
    {
        $this->request = new Request();
        $this->controller = new Controller();
        $this->router = new Router();
        $this->handle();
    }

    private function handle(){
        // print("handling .... request: ");
        // var_dump($this->request);
        $controllerMethod = $this->router->getControllerMethod();
        //this is returning page.php
        $controllerMethod = substr($controllerMethod, 0, -4); //get rid of .php
        if( method_exists($this->controller,$controllerMethod)){
            $this->controller->$controllerMethod($this->request);
        }
    }
}

?>