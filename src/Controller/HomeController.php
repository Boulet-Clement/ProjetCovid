<?php

namespace App\Controller;

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
