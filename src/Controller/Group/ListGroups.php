<?php
namespace App\Controller\Group;

use App\Controller\BaseController;
use Doctrine\ORM\EntityManager;

use App\Model\Group;
use Psr\Http\Message\ResponseInterface as Response;
use Slim\Views\Twig;

class ListGroups extends BaseController{
    private $em;
    private $twig;
    private $userRepository;
    private $groupRepository;
    protected function action():Response
    {        
        $user =  $this->userRepository->findOneBy(array('id'=> $_SESSION['id']));
        $groups = $this->userRepository->find($user->getId())->getGroups();
        return $this->twig->render($this->response,"group/group.html.twig",[
            "session"=>$_SESSION,
            "groups"=>$groups
    ]);
    }
    public function __construct(EntityManager $em, Twig $twig)
    {
        $this->em = $em;
        $this->twig = $twig;
        $this->userRepository = $em->getRepository('App\Model\User');
        $this->groupRepository = $em->getRepository('App\Model\Group');
    }
}