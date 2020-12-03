<?php

namespace app\core;

/**
*  @package app\core\Router
*/

class Application
{
  /**
  *
  * Apllication shpuld have Router,Request,Session Globaly Accessablable
  *
  * */

  public Router $router;
  public Request $request;
  public Response $response;
  public static string $ROOT_DIR;
  public static $app;

  public function __construct() {
    self::$ROOT_DIR = realpath(__DIR__.'/../');
    self::$app = $this;
    $this->request = new Request();
    $this->response = new Response();
    $this->router = new Router($this->request,$this->response);
  }
  public function run() {
    $this->router->resolve();
  }
}