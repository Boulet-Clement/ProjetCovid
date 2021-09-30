<?php

namespace App\Controller;
/*
use App\Model\HomeClass;
require __DIR__ . '/../../src/Model/homeClass.php';*/

class AuthController
{

    public function __construct()
    {
        return;
    }
    
    public function signUp(array $data)
    {
      $login = $data['login'];
      return $login;
    }
    public function signIn(){

    }
    public function signOut(){
        
    }
}