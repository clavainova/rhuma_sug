<?php

namespace App;

class Request
{
    private $url;
    private $method;
    private $type;
    private $params;

    public function __construct(){
        $this->url = $_SERVER["PHP_SELF"];
        $this->method = $_SERVER["REQUEST_METHOD"];
        $this->type = $_SERVER["HTTP_ACCEPT"];
        $this->params = $_REQUEST;
    }
}

?>