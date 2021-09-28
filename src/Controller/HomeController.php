<?php

namespace App\Controller;
use App\Model\HomeClass;
require __DIR__ . '/../../src/Model/homeClass.php';

class HomeController
{
    private $view;

    public function __construct()
    {
        return;
    }
    
    public function home()
    {
      $vue = new HomeClass();
      // your code here
      // use $this->view to render the HTML
      // ...
    return "hello";
    }
}