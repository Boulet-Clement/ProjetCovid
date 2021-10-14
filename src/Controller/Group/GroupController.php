<?php
namespace App\Controller\User;

use App\Controller\BaseController;
use Doctrine\ORM\EntityManager;

use App\Model\User;
use Psr\Http\Message\ResponseInterface as Response;

require __DIR__ . '/../../Model/User.php';

class GroupList extends BaseController{
    private $em;
    protected function action():Response
    {   
        $parsedBody = $this->request->getParsedBody();
        $firstname = htmlspecialchars($parsedBody['firstname']);
        $lastname = htmlspecialchars($parsedBody['lastname']);
        $mail = htmlspecialchars($parsedBody['mail']);
        $login = htmlspecialchars($parsedBody['login']);
        $password =  htmlspecialchars($parsedBody['password']);
        $user = new User(null,$login,$firstname,$lastname,$mail,$password);
        $this->em->persist($user);
        $this->em->flush();
        return $this->response;
    }
    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }
}