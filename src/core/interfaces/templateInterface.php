<?php

namespace core\interfaces;

interface templateInterface
{
  public function render(
    string $view,
    array $data = [],
    string $viewPath = VIEW_PATH
  ); //render
}
