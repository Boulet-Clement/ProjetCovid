<?php

namespace App\Controller;
use App\Model\HomeClass;
require __DIR__ . '/../../src/Model/homeClass.php';

class HomeController
{
    private $view;

    public function __construct()
    {
        $_REQUEST['variable'] = "je viens du controller";
        return;
    }

    public function home()
    {
     
    }

}
