<?php

namespace core\controllers;

class ErrorController
{
  public function notFound()
  {

    // dd(VIEW_PATH_CORE);
    view('errors/404', [
      'title' => 'Página não encontrada'
    ], VIEW_PATH_CORE);
  } // notFound
}
