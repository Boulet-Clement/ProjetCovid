<?php

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Views\Twig;

class HomeController
{

    public function __construct()
    {
        return;
    }
    
    public function home($request, $response, array $args)
    {
      // your code here
      // use $this->view to render the HTML
      // ...
    return "hello";
    }
}