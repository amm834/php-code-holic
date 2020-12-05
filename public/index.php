<?php
require_once __DIR__.'/../vendor/autoload.php';
use app\core\Application;
use app\controllers\AuthController;

$app = new Application();

// Site Controller
$app->router->get('/','home');

// Contact View
$app->router->get('/contact','contact');

// LoginController
$app->router->get('/login',[AuthController::class,'login']);
$app->router->post('/login',[AuthController::class,'login']);

// Start Routimg
$app->run();

?>
