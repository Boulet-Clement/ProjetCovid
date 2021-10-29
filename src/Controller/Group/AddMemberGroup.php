<?php
namespace App\Controller\Group;

use App\Controller\BaseController;
use Doctrine\ORM\EntityManager;

use App\Model\Group;
use Psr\Http\Message\ResponseInterface as Response;
use Slim\Views\Twig;


class AddMemberGroup extends BaseController
{
    private $em;
    private $userRepository;
    /**
     * {@inheritdoc}
     */
    protected function action(): Response
    {
        $parsedBody = $this->request->getParsedBody();
        $groupId = htmlspecialchars($parsedBody['groupId']);
        $group = $this->groupRepository->find($groupId);
        $username = htmlspecialchars($parsedBody['username']);
        $user =  $this->userRepository->findOneBy(array('username'=> $username));
        $route = '/group' . '/' . $groupId;
        if ($user != null){
            $user->addGroup($group);
            $this->em->flush();
            $_SESSION['theme']="";
            $_SESSION['message']="";
            return $this->response
            ->withHeader('location',$route)
            ->withStatus(302);
        }else{
            $_SESSION['theme']="danger";
            $_SESSION['message']='Veuillez entrer un nom d\'utilisateur valide';
            
            return $this->response
            ->withHeader('location',$route)
            ->withStatus(302);
        }
        
        
        //Trouver le user en BDD, l'ajouter au group
        



//
        

        return $this->response; // A changer par la suite pour être plus propre

    }
    public function __construct(EntityManager $em, Twig $twig)
    {
        $this->em = $em;
        $this->twig = $twig;
        $this->userRepository = $em->getRepository('App\Model\User');
        $this->groupRepository = $em->getRepository('App\Model\Group');
    }
}
