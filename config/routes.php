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
        //Si connecté, envoyer à la page d'accueil?
        return $this->get(Twig::class)->render($response,"auth/signIn.html.twig",["session"=>$_SESSION]);
    });
    $group->post('', SignInUser::class);
});
$app->group('/signup', function (RouteCollectorProxy $group) {
    $group->get('', function(Request $request, Response $response){
        //Si déja existant : envoyer sur la page de signin
        return $this->get(Twig::class)->render($response,"auth/signUp.html.twig",["session"=>$_SESSION]);
    });
    $group->post('', SignUpUser::class);
});

$app->group('/group', function (RouteCollectorProxy $group) {
    $group->get('', ListGroups::class);
    $group->post('', CreateGroup::class);
    $group->get('/{id}', ViewGroup::class);
    $group->post('/add-member', AddMemberGroup::class);
    $group->post('/send-message', SendMessageGroup::class);
});
/*
$app->group(
    '/groups', function (Group $group) {
        $group->get('/create', function (Request $request, Response $response) {
            return $this->get(Twig::class)->render($response, "/group/create_group.twig", []);
            });
        $group->get('', ListGroupsAction::class);
        $group->post('', CreateGroupAction::class);
        $group->post('/{id}/delete', DeleteGroupAction::class);
        $group->get('/{id}/modify', ViewModifyGroupForm::class);
        $group->post('/{id}/modify', ModifyGroupAction::class);
        $group->post('/{id}/users/add', AddUserGroupAction::class);
        $group->post('/{id}/users/add_multiple', AddUsersGroupAction::class);
        $group->post('/{id}/users/{user_id}/delete', DeleteUserGroupAction::class);
        

    }
);
*/

$app->group('/contact', function (RouteCollectorProxy $group) {
    $group->get('', function(Request $request, Response $response){
        return $this->get(Twig::class)->render($response,"contact/index.html.twig",["session"=>$_SESSION]);
    });
    $group->post('', SignUpUser::class);
});

$app->post('create-group', CreateGroup::class);