<?php
require_once __DIR__.'/../vendor/autoload.php';
use app\core\Application;


$app = new Application();
$app->router->get('/','home');

$app->router->get('/contact',function (){
  return 'I  am contact';
});

$app->run();