<?php
namespace App\Controller\User;
use Doctrine\ORM\EntityManager;

use App\Controller\BaseController;
use Psr\Http\Message\ResponseInterface as Response;

class SignInUser extends BaseController{
    private $em;
    private $userRepository;
    protected function action():Response
    {   
        $parsedBody = $this->request->getParsedBody();
        $username = htmlspecialchars($parsedBody['username']);
        $password =  htmlspecialchars($parsedBody['password']);
        $latitude =  $parsedBody['latitude'];
        $longitude =  $parsedBody['longitude'];
        $user = $this->userRepository->findOneBy(array('username'=> $username));
        if($user != null){
            if(password_verify($password,$user->getPassword())){                
                $user->setLatitude($latitude);
                $user->setLongitude($longitude);
                $this->em->persist($user);
                $this->em->flush();
                
                /* On place quelques utilisateur autour de l'utilisateur qui se connecte
                pour simuler un peu de monde aux alentours */
                $userTwo = $this->userRepository->findOneBy(array('id'=> 2));
                $userTwo->setLatitude($latitude+0.001);
                $userTwo->setLongitude($longitude-0.001);

                $userThree = $this->userRepository->findOneBy(array('id'=> 3));
                $userThree->setLatitude($latitude-0.0015);
                $userThree->setLongitude($longitude+0.002);
                
                $this->em->persist($userTwo);
                $this->em->persist($userThree);
                $this->em->flush();

                $latitude_min = $latitude - 0.01;
                $latitude_max = $latitude + 0.01;
                $longitude_min = $longitude - 0.01;
                $longitude_max = $longitude + 0.01;

                $qb = $this->em->createQueryBuilder()
                ->select('u')
                ->from('App\Model\User', 'u')
                ->Where('u.latitude  >= :latitude_min')
                ->andWhere('u.latitude  <= :latitude_max')
                ->andWhere('u.longitude  >= :longitude_min')
                ->andWhere('u.longitude  <= :longitude_max')
                ->setParameter('latitude_min', $latitude_min)
                ->setParameter('latitude_max', $latitude_max)
                ->setParameter('longitude_min', $longitude_min)
                ->setParameter('longitude_max', $longitude_max)
                ->getQuery()
                ->getResult();
                $tabNearUsers = [];
                foreach ($qb as $nearUser) {
                    if($nearUser->getId() != $user->getId()){     
                        $unUser = $nearUser->exportAsArray();
                        array_push($tabNearUsers,$unUser);
                    }
                }

                $nearUsers = json_encode($tabNearUsers);

                $_SESSION['theme']="";
                $_SESSION['message']="";
                $_SESSION['username'] = $username;
                $_SESSION['user'] = $user;
                $_SESSION['id'] = $user->getId();
                $_SESSION['nearUsers'] = $nearUsers;

                
                return $this->response
                ->withHeader('location','/')
                ->withStatus(302);
            }else{
                $_SESSION['theme']="danger";
                $_SESSION['message']="Mauvais identifiants";
                return $this->response
                ->withHeader('location','/signin')
                ->withStatus(302);
            }
        }else{
            $_SESSION['theme']="danger";
            $_SESSION['message']="L'identifiant n'existe pas";
            return $this->response
            ->withHeader('location','/signin')
            ->withStatus(302);
        }
    }
    public function __construct(EntityManager $em)
    {
        $this->em = $em;
        $this->userRepository = $em->getRepository('App\Model\User');
    }

}