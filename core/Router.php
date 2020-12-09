<?php
namespace app\core;

/**
* @package app\core\Application
*/

class Router
{
  protected array $routes = [];
  protected Request $request;
  protected Response $response;

  public function __construct(Request $request, Response $response) {
    $this->request = $request;
    $this->response = $response;
  }

  public function get($path, $callback) {
    /**
    * Assign Route URI as $callback Function to execute
    * */
    $this->routes['get'][$path] = $callback;
  }

  public function post($path, $callback) {
    /**
    * Assign Route URI as $callback Function to execute
    * */
    $this->routes['post'][$path] = $callback;
  }

  public function resolve() {
    $path = $this->request->getPath();
    $method = $this->request->getMethod();
    $callBack = $this->routes[$method][$path] ?? false;
    if ($callBack === false) {
      $this->response->setStatusCode(404);
      $this->renderView("_404");
      exit;
    }
    // If Callback is FileName
    if (is_string($callBack)) {
      echo $this->renderView($callBack);
      exit;
    }

    /**
    * Point Object $this->*
    * */

    if (is_array($callBack)) {
      $callBack[0] = new $callBack[0]();
    }
    echo call_user_func($callBack,$this->request);
  }

  // Render Views and Layouts
  public function renderView($view, $params = []) {
    $layout = $this->renderLayout();

    /**
    * Get Params from
    * @package app\core\Controller
    * */

    $layoutContent = $this->renderOnlyView($view, $params);
    echo str_replace("{{content}}", $layoutContent, $layout);
  }

  /**
  * Render Layout
  * @file views/layouts/main.php
  * */

  public function renderLayout() {
    ob_start();
    include_once Application::$ROOT_DIR."/views/layouts/master.php";
    return ob_get_clean();
  }

  /**
  * Render Content Of Sub View File
  * to replace {{content}}
  * */

  public function renderOnlyView($view, $params) {
    /**
    * Get Params from
    * @package app\core\Controller
    * and assign as $$key -> variable name to echo from view
    * */
    foreach ($params as $key => $value) {
      $$key = $value;
    }
    ob_start();
    include_once Application::$ROOT_DIR."/views/$view.php";
    return ob_get_clean();
  }

}