<?php
use App\Controller\HomeController;
use App\Controller\User\SignInUser;
use Slim\Views\PhpRenderer;
use Slim\Routing\RouteCollectorProxy;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

require __DIR__ . '/../src/Controller/HomeController.php';
require __DIR__ . '/../src/Controller/User/SignInUser.php';


$app->get('/',function ($request, $response, array $args){
    $home = new HomeController();
    $renderer = new PhpRenderer('../src/Vue');
    return $renderer->render($response,'homeVue.php', $args);
});
$app->group('/login', function (RouteCollectorProxy $group) {
    $group->get('', function(Request $request, Response $response){
        //Si connecté, envoyer à la page d'accueil?
        $renderer = new PhpRenderer('../src/Vue');
        return $renderer->render($response,'loginVue.php');
    });
    $group->post('', SignInUser::class);    
}
);





