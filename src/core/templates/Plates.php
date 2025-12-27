<?php

namespace core\templates;

use League\Plates\Engine;
use core\interfaces\templateInterface;

class Plates implements templateInterface
{
    public function render($view,  $data = [], $viewPath = VIEW_PATH){

      // Create new Plates instance
      $templates = new Engine($viewPath);

      // Render a template
      echo $templates->render($view, $data,);
    }// render
}
