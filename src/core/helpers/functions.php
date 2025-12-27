<?php

use core\library\Layout;
use core\library\Container;

function view(string $view, array $data = [], $viewPath = VIEW_PATH)
{
  return Layout::render($view, $data, $viewPath);
}

function bind(
  string $key,
  mixed $value
) {
  Container::bind($key, $value);
}

function resolve(string $key)
{

  return Container::resolve($key);
}
