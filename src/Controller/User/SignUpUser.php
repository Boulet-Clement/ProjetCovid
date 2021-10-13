<?php
namespace App\Controller\User;

use App\Controller\BaseController;
use Doctrine\ORM\EntityManager;

use App\Model\User;
use Doctrine\DBAL\Driver\PDO\Exception as PDOException;
use Exception;
use Psr\Http\Message\ResponseInterface as Response;

require __DIR__ . '/../../Model/User.php';

class SignUpUser extends BaseController{
    private $em;
    protected function action():Response
    {   
        $parsedBody = $this->request->getParsedBody();
        $firstname = htmlspecialchars($parsedBody['firstname']);
        $lastname = htmlspecialchars($parsedBody['lastname']);
        $mail = htmlspecialchars($parsedBody['mail']);
        $login = htmlspecialchars($parsedBody['login']);
        $password =  htmlspecialchars($parsedBody['password']);
        var_dump($parsedBody);
        $user = new User(null,$login,$firstname,$lastname,$mail,$password);
        var_dump($user);
        $this->em->persist($user);
            echo "ok";
        try{
            $this->em->flush();
        }catch(Exception $e){
            echo $e;
        }
        
        echo "la c'est plus ok";
        return $this->response;
    }
    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }
}