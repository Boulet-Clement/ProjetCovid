<?php
use App\Controller\HomeController;
use App\Controller\AuthController;
use Slim\Views\PhpRenderer;

require __DIR__ . '/../src/Controller/HomeController.php';
require __DIR__ . '/../src/Controller/AuthController.php';

$app->get('/',function ($request, $response, array $args){
    $home = new HomeController();
    $renderer = new PhpRenderer('../src/Vue');
    return $renderer->render($response,'homeVue.php', $args);
});

$app->get('/signUp',function ($request, $response, array $args){
    //$auth = new AuthController();
    $renderer = new PhpRenderer('../src/Vue');
    //$response->getBody()->write($home->signUp());
    return $renderer->render($response,'signUpVue.php', $args);
});
$app->post('/signUpForm',function ($request, $response, array $args){
    $data = $request->getParsedBody();
    $auth = new AuthController();
    $retour = $auth->signUp($data);

    $response->getBody()->write($retour);
    return $response;
});
