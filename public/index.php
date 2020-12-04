<?php
require_once __DIR__.'/../vendor/autoload.php';
use app\core\Application;
use app\controllers\SiteController;

$app = new Application();
$app->router->get('/','home');

$app->router->get('/contact',[SiteController::class,'contact']);
$app->router->post('/contact','contact');

$app->run();

?>
