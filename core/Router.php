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

  public function resolve() {
    $path = $this->request->getPath();
    $method = $this->request->getMethod();
    $callBack = $this->routes[$method][$path] ?? false;
    if ($callBack === false) {
      $this->response->setStatusCode(404);
      echo '404 Not Found!';
      exit;
    }
    // If Callback is FileName
    if (is_string($callBack)) {
      echo $this->renderView($callBack);
      exit;
    }
    echo call_user_func($callBack);
  }

  // Render Views and Layouts
  public function renderView($view) {
    $layout = $this->renderLayout();
    $layoutContent = $this->renderOnlyView($view);
    return str_replace("{{content}}", $layoutContent, $layout);
  }

  public function renderLayout() {
    ob_start();
    include_once Application::$ROOT_DIR."/views/layouts/master.php";
    return ob_get_clean();
  }

  public function renderOnlyView($view) {
    ob_start();
    include_once Application::$ROOT_DIR."/views/$view.php";
    return ob_get_clean();
  }

}