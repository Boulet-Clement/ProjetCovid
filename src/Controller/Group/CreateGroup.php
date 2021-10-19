<?php
namespace App\Controller\Group;

use App\Controller\BaseController;
use Doctrine\ORM\EntityManager;

use App\Model\Group;
use Psr\Http\Message\ResponseInterface as Response;

require __DIR__ . '/../../Model/Group.php';

class CreateGroup extends BaseController{
    private $em;
    protected function action():Response
    {   echo "ah";
        $parsedBody = $this->request->getParsedBody();
        $groupName = htmlspecialchars($parsedBody['groupName']);
        //$username = $_SESSION['username'];
        $description = "";
        $group = new Group(null,$groupName,$description,"ah");
        $this->em->persist($group);
        $this->em->flush();
        return $this->response;
    }
    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }
}