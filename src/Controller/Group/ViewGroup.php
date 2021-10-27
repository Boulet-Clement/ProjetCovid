<?php
namespace App\Controller\Group;

use App\Controller\BaseController;
use Doctrine\ORM\EntityManager;

use App\Model\Group;
use Psr\Http\Message\ResponseInterface as Response;
use Slim\Views\Twig;


class ViewGroup extends BaseController
{
    /**
     * {@inheritdoc}
     */
    protected function action(): Response
    {
        $groupId = (int) $this->args['id'];
        $group = $this->groupRepository->find($groupId);

        if (isset($group)) {
            return $this->twig->render($this->response, "/group/viewGroup.html.twig", ["group" => $group, "session" => $_SESSION]);
        }else{
            return $this->response; // A changer par la suite pour être plus propre
        }
        
    }
    public function __construct(EntityManager $em, Twig $twig)
    {
        $this->em = $em;
        $this->twig = $twig;
        $this->userRepository = $em->getRepository('App\Model\User');
        $this->groupRepository = $em->getRepository('App\Model\Group');
    }
}
