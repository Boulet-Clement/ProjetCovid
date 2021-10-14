<?php
namespace App\Controller\User;

use App\Controller\BaseController;
use Doctrine\ORM\EntityManager;

use App\Model\User;
use Psr\Http\Message\ResponseInterface as Response;

require __DIR__ . '/../../Model/User.php';
require __DIR__ . '/../../Repository/UserRepository.php';

class SignUpUser extends BaseController{
    private $em;
    private $userRepository;

    protected function action():Response
    {   
        $parsedBody = $this->request->getParsedBody();
        $firstname = htmlspecialchars($parsedBody['firstname']);
        $lastname = htmlspecialchars($parsedBody['lastname']);
        $mail = htmlspecialchars($parsedBody['mail']);
        $login = htmlspecialchars($parsedBody['login']);
        $password =  htmlspecialchars($parsedBody['password']);
        /*$test = $this->userRepository->findOneBy(array('username'=> 'test'));
        var_dump($test);*/
        $user = new User(null,$login,$firstname,$lastname,$mail,$password);
        if(! $this->is_already_existing($user)){
            $this->em->persist($user);
            /* Rediriger sur la page de connexion en disant bienvenue */
            $this->em->flush();
            $_SESSION['message'] = 'Bienvenue';
            return $this->response
            ->withHeader('location','/signin')
            ->withStatus(302);
        }else{
            $_SESSION['message'] = 'Le compte existe déjà';
            return $this->response;
            /* Rediriger sur la page de connexion en disant qu'il existe déjà */
        }
        
        
    }
    public function __construct(EntityManager $em)
    {
        $this->em = $em;
        $this->userRepository = $em->getRepository('App\Model\User');
    }
    private function is_already_existing($user)
    {
        $is_existing = false;
        if($this->userRepository->findOneBy(array('username'=> $user->getUsername()))){
            $is_existing = true ;
        }
        if($this->userRepository->findOneBy(array('mail'=> $user->getMail()))){
            $is_existing = true ;
        }

        return $is_existing;
    }
}