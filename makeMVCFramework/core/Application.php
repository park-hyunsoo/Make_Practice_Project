<?php

namespace app\core;

class Application
{
    public Router $router; // php 7.4 타입 추가
    public Request $request;

    public function __construct()
    {
        
        $this->request = new Request();
        $this->router = new Router($this->request);
    }

    public function run()
    {
        $this->router->resolve();   
    }
}