<?php

use App\Controller\User\SignInUser;
use App\Controller\User\SignUpUser;

use Slim\Routing\RouteCollectorProxy;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Views\Twig;

require __DIR__ . '/../src/Controller/BaseController.php';

require __DIR__ . '/../src/Controller/User/SignInUser.php';
require __DIR__ . '/../src/Controller/User/SignUpUser.php';

$app->get('/',function ($request, $response, array $args){
    return $this->get(Twig::class)->render($response,"home/index.html.twig");
});
$app->group('/signin', function (RouteCollectorProxy $group) {
    $group->get('', function(Request $request, Response $response){
        //Si connecté, envoyer à la page d'accueil?
        return $this->get(Twig::class)->render($response,"auth/signIn.html.twig");
    });
    $group->post('', SignInUser::class);    
});
$app->group('/signup', function (RouteCollectorProxy $group) {
    $group->get('', function(Request $request, Response $response){
        //Si déja existant : envoyer sur la page de signin
        return $this->get(Twig::class)->render($response,"auth/signUp.html.twig");
    });
    $group->post('', SignUpUser::class);    
});
$app->get('/group',function ($request, $response, array $args){
    return $this->get(Twig::class)->render($response,"group/index.html.twig");
});