<?php
namespace App\Controller\User;

use App\Controller\BaseController;
use Psr\Http\Message\ResponseInterface as Response;

class SignInUser extends BaseController{
    protected function action():Response
    {   
        $parsedBody = $this->request->getParsedBody();
        $login = htmlspecialchars($parsedBody['login']);
        $password =  htmlspecialchars($parsedBody['password']);
        return $this->response;
    }
    public function __construct()
    {
    }

}