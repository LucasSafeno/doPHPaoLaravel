<?php

use core\library\App;


$app = App::create()
  ->withEnvironmentVariables()
  ->withTemplateEngine(Plates::class)
  ->withErroPage()
  ->withContainer();
