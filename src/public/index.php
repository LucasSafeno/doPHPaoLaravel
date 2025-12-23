<?php
// Session
session_start();

// Autoload
require "../vendor/autoload.php";

require "../bootstrap/app.php";

require "../routes/web.php";

class HomeController
{
  public function index()
  {
    view("index");
  }
}

$controller = new HomeController();
dd($controller->index());
