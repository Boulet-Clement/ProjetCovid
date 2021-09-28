<?php

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Views\Twig;
namespace App\Controller;
require __DIR__ . '/../../src/Model/homeClass.php';

class HomeClass //a bouger
{
    private $tab = [
        'test' => 'ah'
    ];
    public function getTab(){
        return $this->tab;
    }
    public function setInSession(){
        $_SESSION['Vue'] = $this;
    }
    public function __construct(){
        $this->setInSession();
    }
} 
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