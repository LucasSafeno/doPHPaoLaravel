<?php

namespace core\templates;

use League\Plates\Engine;

class Plates
{
    public function render($view,  $data = [], $viewPath = VIEW_PATH){

      // Create new Plates instance
      $templates = new Engine($viewPath);

      // Render a template
      echo $templates->render($view, $data,);
    }// render
}
