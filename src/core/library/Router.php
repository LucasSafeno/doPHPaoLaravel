<?php

namespace core\library;

use DI\Container;
use core\controllers\ErrorController;
use core\exceptions\ControllerNotFoundException;

class Router
{
  protected array $routes = [];
  protected ?string $controller = null;
  protected string $action;
  protected array $params = [];


  public function __construct(
    private Container $container
  ) {} // construct()

  public function add(
    string $method,
    string $uri,
    array $route
  ) {
    $this->routes[$method][$uri] = $route;
  } //add()

  public function execute()
  {
    // Percorrer o routes
    foreach ($this->routes as $request => $routes) {
      if ($request === REQUEST_METHOD) {
        return $this->handleUri($routes);
      }
    }
  } // execute()

  private function handleUri(array $routes)
  {
    foreach ($routes as $uri => $route) {

      if ($uri === REQUEST_URI) {
        [$this->controller, $this->action] = $route;
        break;
      }

      $pattern = str_replace('/', '\/', trim($uri, '/'));
      if ($uri !== '/' && preg_match("/^$pattern$/", trim(REQUEST_URI, '/'), $this->params)) {
        [$this->controller, $this->action] = $route;
        unset($this->params[0]);
        break;
      }
    }


    if ($this->controller) {
      return $this->handleController();
    }
    return $this->handleNotFound();
  } // handleUri()


  private function handleController()
  {


    if (!class_exists($this->controller) || !method_exists($this->controller, $this->action)) {
      throw new ControllerNotFoundException(
        "[$this->controller::$this->action] does not exits"
      );
    }


    $controller = $this->container->get($this->controller);
    $this->container->call([$controller, $this->action], [...$this->params]);
  } // handleController()

  private function handleNotFound()
  {
    (new ErrorController)->notFound();
  } // handleNotFound()

}
