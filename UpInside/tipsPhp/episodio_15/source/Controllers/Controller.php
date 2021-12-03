<?php

namespace Source\Controllers;

use CoffeeCode\Router\Router;
use League\Plates\Engine;

/**
 * Description of Controller
 *
 * @author Administrator
 */
abstract class Controller
{
    /** @var Engine */
    protected $view;
    
    /** @var Router */
    protected $router;
    
    public function __construct($router, $dir = null, $globals = [])
    {
        $dir = $dir ?? dirname(__DIR__, 2) . "/theme/";
        $this->view = Engine::create($dir, "php");
        $this->router = $router;
        
        $this->view->addData(["router" => $this->router]);
        if($globals){
            $this->view->addData($globals);
        }
    }
    
    public function ajaxMessage(string $message, string $type): string
    {
        return json_encode(["message" => "<div class=\"message {$type}\">{$message}</div>"]);
    }
}
