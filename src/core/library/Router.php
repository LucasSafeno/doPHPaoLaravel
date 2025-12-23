<?php

namespace core\library;

use DI\Container;
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
      return $this->handleController(
        $this->controller,
        $this->action,
        $this->params
      );
    }

    return $this->handleNotFound();
  } // handleUri()


  private function handleController(
    string $controller,
    string $action,
    array $params
  ) {

    if (!class_exists($controller) || !method_exists($controller, $action)) {
      throw new ControllerNotFoundException(
        "[$controller::$action] does not exits"
      );
    }


    $controller = $this->container->get($controller);
    $this->container->call([$controller, $action], [...$params]);
  } // handleController()

  private function handleNotFound()
  {
    dump('Not found Controller');
  } // handleNotFound()

}
