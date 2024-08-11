<?php
use Controllers\AccountsController;
use Controllers\HomeController;
use Controllers\LoginController;
use Services\Router;

$router = new Router();

$router->get('/', HomeController::class, 'index');
$router->get('/login', LoginController::class, 'showLoginForm');
$router->post('/login', LoginController::class, 'processLogin');
$router->post('/logout', LoginController::class, 'logout', 'auth');


$router->get('/dashboard', HomeController::class, 'dashboard', 'auth');





$router->dispatch();
