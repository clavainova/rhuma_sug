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
        $controllerMethod = $this->router->getControllerMethod();
        if( method_exists($this->controller,$controllerMethod)){
            $this->controller->$controllerMethod($this->request);
        }
    }
}

?>