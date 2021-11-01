<?php
namespace App\Controller\User;

use App\Controller\BaseController;
use Doctrine\ORM\EntityManager;

use App\Model\User;
use Psr\Http\Message\ResponseInterface as Response;

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
        $confirmPassword =  htmlspecialchars($parsedBody['confirm_password']);
        if(!empty($firstname) && !empty($lastname) && !empty($mail) && !empty($login) && !empty($password)){
           if($password === $confirmPassword){
                $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
                $user = new User(null,$login,$firstname,$lastname,$mail,$hashedPassword,null,null);
                //$user = new User(null,$login,$firstname,$lastname,$mail,$password);
                if(!$this->is_already_existing($user)){
                    $this->em->persist($user);
                    $this->em->flush();
                    $_SESSION['theme']="success";
                    $_SESSION['message']='Votre compte à bien été enregistré, veuillez vous connecter pour vérifier.';
                    return $this->response
                    ->withHeader('location','/signin')
                    ->withStatus(302);
                }else{
                    $_SESSION['theme']="danger";
                    $_SESSION['message']='Ce compte est déjà existant.';
                    return $this->response
                    ->withHeader('location','/signin')
                    ->withStatus(302);
                }
            }else{
                $_SESSION['theme']="danger";
                $_SESSION['message']='Les deux mots de passe ne sont pas identiques.';
                return $this->response
                ->withHeader('location','/signup')
                ->withStatus(302);
            } 
        }else{
            $_SESSION['theme']="danger";
            $_SESSION['message']='Veuillez remplir tous les champs';
            return $this->response
            ->withHeader('location','/signup')
            ->withStatus(302);
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