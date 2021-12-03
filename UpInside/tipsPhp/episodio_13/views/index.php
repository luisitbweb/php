<?php

use CoffeeCode\Router\Router;

require "../vendor/autoload.php";

$router = new Router(ROOT);
$router->namespace("Source\Controllers");

$router->group(null);
$router->get("/", "Form:home", "Form.home");
$router->post("/create", "Form:create", "Form.create");
$router->post("/delete", "Form:delete", "Form.delete");


$router->dispatch();

if ($router->error()) {
    var_dump($router->error());
}