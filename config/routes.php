<?php

use App\Controller\User\SignInUser;
use App\Controller\User\SignUpUser;

use App\Controller\Group\CreateGroup;
use App\Controller\Group\ViewGroup;
use App\Controller\Group\ListGroups;
use App\Controller\Group\AddMemberGroup;
use App\Controller\Group\SendMessageGroup;

use Slim\Routing\RouteCollectorProxy;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Views\Twig;

require __DIR__ . '/../src/Controller/BaseController.php';

require __DIR__ . '/../src/Controller/User/SignInUser.php';
require __DIR__ . '/../src/Controller/User/SignUpUser.php';

require __DIR__ . '/../src/Controller/Group/CreateGroup.php';
require __DIR__ . '/../src/Controller/Group/ListGroups.php';
require __DIR__ . '/../src/Controller/Group/ViewGroup.php';
require __DIR__ . '/../src/Controller/Group/AddMemberGroup.php';
require __DIR__ . '/../src/Controller/Group/SendMessageGroup.php';

$app->get('/',function ($request, $response, array $args){
    return $this->get(Twig::class)->render($response,"home/index.html.twig",["session"=>$_SESSION]);
});
$app->group('/signin', function (RouteCollectorProxy $group) {
    $group->get('', function(Request $request, Response $response){
                $csrf = $this->get('csrf');
        $nameKey = $csrf->getTokenNameKey();
        $valueKey = $csrf->getTokenValueKey();
        $name = $request->getAttribute($nameKey);
        $value = $request->getAttribute($valueKey);
        //Si connecté, envoyer à la page d'accueil?
        return $this->get(Twig::class)->render($response,"auth/signIn.html.twig",[
            "session"=>$_SESSION,
            "nameKey"=>$nameKey,
            "valueKey"=>$valueKey,
            "name"=>$name,
            "value"=>$value
        ]);
    });
    $group->post('', SignInUser::class);
});
$app->group('/signup', function (RouteCollectorProxy $group) {
    $group->get('', function(Request $request, Response $response){
        $csrf = $this->get('csrf');
        $nameKey = $csrf->getTokenNameKey();
        $valueKey = $csrf->getTokenValueKey();
        $name = $request->getAttribute($nameKey);
        $value = $request->getAttribute($valueKey);
        return $this->get(Twig::class)->render($response,"auth/signUp.html.twig",[
            "session"=>$_SESSION,
            "nameKey"=>$nameKey,
            "valueKey"=>$valueKey,
            "name"=>$name,
            "value"=>$value
        ]);
    });
    $group->post('', SignUpUser::class);
});

$app->get('/signout', function (Request $request, Response $response) {
    session_unset();
    return $response
        ->withHeader('Location', '/')
        ->withStatus(302);
  }
);


$app->group('/group', function (RouteCollectorProxy $group) {
    $group->get('', ListGroups::class);
    $group->post('', CreateGroup::class);
    $group->get('/{id}', ViewGroup::class);
    $group->post('/add-member', AddMemberGroup::class);
    $group->post('/send-message', SendMessageGroup::class);
});

$app->group('/contact', function (RouteCollectorProxy $group) {
    $group->get('', function(Request $request, Response $response){
        return $this->get(Twig::class)->render($response,"contact/index.html.twig",["session"=>$_SESSION]);
    });
    $group->post('', SignUpUser::class);
});

$app->post('create-group', CreateGroup::class);