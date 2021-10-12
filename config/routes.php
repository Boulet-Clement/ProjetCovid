<?php
use App\Controller\HomeController;

use App\Controller\User\SignInUser;
use App\Controller\User\SignUpUser;

use Slim\Views\PhpRenderer;
use Slim\Routing\RouteCollectorProxy;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

require __DIR__ . '/../src/Controller/HomeController.php';
require __DIR__ . '/../src/Controller/BaseController.php';

require __DIR__ . '/../src/Controller/User/SignInUser.php';
require __DIR__ . '/../src/Controller/User/SignUpUser.php';


$app->get('/',function ($request, $response, array $args){
    $home = new HomeController();
    $renderer = new PhpRenderer('../src/Vue');
    return $renderer->render($response,'homeVue.php', $args);
});
$app->group('/signin', function (RouteCollectorProxy $group) {
    $group->get('', function(Request $request, Response $response){
        //Si connecté, envoyer à la page d'accueil?
        $renderer = new PhpRenderer('../src/Vue');
        return $renderer->render($response,'signInVue.php');
    });
    $group->post('', SignInUser::class);    
});
$app->group('/signup', function (RouteCollectorProxy $group) {
    $group->get('', function(Request $request, Response $response){
        //Si déja existant : envoyer sur la page de signin
        $renderer = new PhpRenderer('../src/Vue');
        return $renderer->render($response,'signUpVue.php');
    });
    $group->post('', SignUpUser::class);    
});





