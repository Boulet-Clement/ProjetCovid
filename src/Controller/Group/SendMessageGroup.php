<?php
namespace App\Controller\Group;

use App\Controller\BaseController;
use Doctrine\ORM\EntityManager;

use App\Model\Group;
use App\Model\User;
use App\Model\GroupMessage;
use Psr\Http\Message\ResponseInterface as Response;
use Slim\Views\Twig;


class SendMessageGroup extends BaseController
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
        $messageContent = htmlspecialchars($parsedBody['message_content']);

        $group = $this->groupRepository->find($groupId);
        $user =  $this->userRepository->findOneBy(array('id'=> $_SESSION['id']));

        $username = $user->getUsername();

        $message = new GroupMessage(null,$username,$messageContent);
        $message->addGroup($group);
        
        $this->em->persist($message);
        $this->em->flush();
        
        $route = '/group' . '/' . $groupId;
        return $this->response
            ->withHeader('location',$route)
            ->withStatus(302);


    }
    public function __construct(EntityManager $em, Twig $twig)
    {
        $this->em = $em;
        $this->twig = $twig;
        $this->userRepository = $em->getRepository('App\Model\User');
        $this->groupRepository = $em->getRepository('App\Model\Group');
    }
}
