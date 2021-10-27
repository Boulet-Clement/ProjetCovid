<?php
namespace App\Controller\Group;

use App\Controller\BaseController;
use Doctrine\ORM\EntityManager;

use App\Model\Group;
use Psr\Http\Message\ResponseInterface as Response;

require __DIR__ . '/../../Model/Group.php';

class CreateGroup extends BaseController{
    private $em;
    private $userRepository;
    protected function action():Response
    {
        $parsedBody = $this->request->getParsedBody();
        $groupName = htmlspecialchars($parsedBody['groupName']);
        $user =  $this->userRepository->findOneBy(array('id'=> $_SESSION['id']));
        $description = "Ceci est une description pour un groupe";
        $group = new Group(null,$groupName,$description,$user);
        $this->em->persist($group);
        $user->addGroup($group);
        $this->em->flush();
        return $this->response
        ->withHeader('Location', '/group' . '/' . $group->getId())
        ->withStatus(302);
;
    }
    public function __construct(EntityManager $em)
    {
        $this->em = $em;
        $this->userRepository = $em->getRepository('App\Model\User');
    }
}