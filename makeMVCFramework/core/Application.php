<?php

namespace app\core;

class Application
{
    public static string $ROOT_DIR;
    public Router $router; // php 7.4 타입 추가
    public Request $request;
    public Response $response;
    public Database $db;
    public Session $session;

    public static Application $app;
    public Controller $controller;

    public function __construct($rootPath, array $config)
    {
        self::$ROOT_DIR = $rootPath;
        self::$app = $this;
        $this->request = new Request();
        $this->response = new Response();
        $this->session = new Session(); 
        $this->router = new Router($this->request, $this->response);

        $this->db = new Database($config['db']);
    }

    public function run()
    {
        echo $this->router->resolve();   
    }

    public function getController()
    {
        return $this->controller;
    }
    
    public function setController(Controller $controller)
    {
        $this->controller = $controller;
    }
}