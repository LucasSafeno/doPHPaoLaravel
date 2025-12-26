<?php

namespace core\library;

use League\Plates\Engine;
use core\templates\Plates;
use core\exceptions\ViewNotFoundExeption;

class Layout
{
  public static function render(
    string $view,
    array $data = [],
    string $viewPath = VIEW_PATH
  ) {


    // dd($viewPath);
    if (!file_exists($viewPath . $view . ".php")) {
      throw new ViewNotFoundExeption(" View not found : $view");
    }

    return (new Plates)->render($view, $data, $viewPath);
  }
}
