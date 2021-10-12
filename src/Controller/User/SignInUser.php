<?php
namespace App\Controller\User;

use App\Controller\BaseController;
use Psr\Http\Message\ResponseInterface as Response;

require __DIR__ . '/../BaseController.php';

class SignInUser extends BaseController{
    protected function action():Response
    {
        return $this->response;
    }
}