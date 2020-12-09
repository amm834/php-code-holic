<?php
namespace app\core;
class Controller
{

  /**
  * Get params from
  * @package app\controllers
  * */

  public function render($view, $params = []) {

    /**
    * Render View from
    * @package app\controllers
    * */

    return Application::$app->router->renderView($view, $params);
  }
}