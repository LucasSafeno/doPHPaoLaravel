<?php

namespace core\library;

use League\Plates\Engine;
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

    // Create new Plates instance
    $templates = new Engine($viewPath);

    // Render a template
    echo $templates->render($view, $data,);
  }
}
