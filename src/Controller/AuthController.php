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
      $login = $_POST['login'];
      $password = $_POST['password'];
      if (!empty($login) && !empty($password))
      {
      $login = htmlentities($_POST['login']);
      $password = htmlentities($_POST['password']);
      session_start();
      $_SESSION['login'] = $_POST['login'];
        echo "<br> connexion reussi";
        VAR_DUMP($password);
      }else{
        echo '<script language="javascript">';
        echo 'alert("Login ou mot de passe incorrect, veuillez réessayer")';
        echo '</script>';
      }
    }
    public function signOut(){
        
    }
}