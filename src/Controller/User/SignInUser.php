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
        $latitude =  $parsedBody['latitude'];
        $longitude =  $parsedBody['longitude'];
        $user = $this->userRepository->findOneBy(array('username'=> $username));
        if($user != null){
            if($password === $user->getPassword()){
                $_SESSION['theme']="";
                $_SESSION['message']="";
                $_SESSION['username'] = $username;
                $_SESSION['user'] = $user;
                $_SESSION['id'] = $user->getId();
                $user->setLatitude($latitude);
                $user->setLongitude($longitude);
                $this->em->persist($user);
                $this->em->flush();
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
        }else{
            $_SESSION['theme']="danger";
            $_SESSION['message']="L'identifiant n'existe pas";
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

}