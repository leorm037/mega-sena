<?php

ob_start();

require __DIR__ . "/vendor/autoload.php";

error();

use CoffeeCode\Router\Router;

$route = new Router(url(), ":");

$route->namespace("PaginaEmConstrucao\Controller");
$route->get("/", "Web:home");

$route->namespace("PaginaEmConstrucao\Controller")->group("/ano");
$route->get("/{ano}", "Web:ano");

$route->namespace("PaginaEmConstrucao\Controller")->group("/ops");
$route->get("/{errorCode}", "Web:error");

$route->dispatch();

if($route->error()) {
    $route->redirect("/ops/{$route->error()}");
}

ob_end_flush();
