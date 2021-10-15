<?php
namespace App\Controller\User;
use Doctrine\ORM\EntityManager;

use App\Controller\BaseController;
use Psr\Http\Message\ResponseInterface as Response;

class SignInUser extends BaseController{
    private $em;
    private $userRepository;
    protected function action():Response
    {   
        $parsedBody = $this->request->getParsedBody();
        $username = htmlspecialchars($parsedBody['username']);
        $password =  htmlspecialchars($parsedBody['password']);
        if($this->is_login_ok($username,$password)){
            $_SESSION['theme']="";
            $_SESSION['message']="";
            $_SESSION['username'] = $username;
            return $this->response
            ->withHeader('location','/')
            ->withStatus(302);
        }else{
            $_SESSION['theme']="danger";
            $_SESSION['message']="Mauvais identifiants";
            return $this->response
            ->withHeader('location','/signin')
            ->withStatus(302);
        }
    }
    public function __construct(EntityManager $em)
    {
        $this->em = $em;
        $this->userRepository = $em->getRepository('App\Model\User');
    }
    private function is_login_ok($username,$password){
        $is_ok = false;
        $user = $this->userRepository->findOneBy(array('username'=> $username));
        if($user != null){
            if($password === $user->getPassword()){
                $is_ok = true ;
            }
        }
        return $is_ok;
    }

}