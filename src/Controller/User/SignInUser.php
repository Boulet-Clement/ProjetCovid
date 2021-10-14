<?php
namespace App\Controller\User;
use Doctrine\ORM\EntityManager;

use App\Controller\BaseController;
use Psr\Http\Message\ResponseInterface as Response;
use Slim\Views\Twig;

class SignInUser extends BaseController{
    private $em;
    private $userRepository;
    private $twig;
    protected function action():Response
    {   
        $parsedBody = $this->request->getParsedBody();
        $username = htmlspecialchars($parsedBody['username']);
        $password =  htmlspecialchars($parsedBody['password']);
        if($this->is_login_ok($username,$password)){

            $_SESSION['username'] = $username;
            return $this->response
            ->withHeader('location','/')
            ->withStatus(302);
        }else{
            return $this->twig->render($this->response,"auth/signIn.html.twig",[
                'message'=>'mauvais identifiants'
            ]);
        }
    }
    public function __construct(EntityManager $em, Twig $twig)
    {
        $this->em = $em;
        $this->userRepository = $em->getRepository('App\Model\User');
        $this->twig = $twig;
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