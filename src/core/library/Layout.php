<?php

namespace core\library;

use League\Plates\Engine;
use core\templates\Plates;
use core\library\Container;
use core\exceptions\ClassNotFoundExption;
use core\exceptions\ViewNotFoundExeption;
use core\interfaces\templateInterface;

class Layout
{
  public static function render(
    string $view,
    array $data = [],
    string $viewPath = VIEW_PATH
  ) {




    $template =  resolve('engine');

    if (!class_exists($template)) {
      throw new ClassNotFoundExption("Template {" . $template::class . "enegine not found");
    }

    $template = new $template();

    if (!$template instanceof templateInterface) {
      throw new ClassNotFoundExption("Template {" . $template::class . " must implement tempalteInterface");
    }

    return $template->render($view, $data, $viewPath);

    //return (new Plates)->render($view, $data, $viewPath);
  }
}
