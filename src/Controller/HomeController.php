<?php

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Views\Twig;
namespace App\Controller;

class HomeController
{
    private $view;

    public function __construct()
    {
        return;
    }
    
    public function home()
    {
      // your code here
      // use $this->view to render the HTML
      // ...
    return "hello";
    }
}