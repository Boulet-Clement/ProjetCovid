<?php
use App\Controller\HomeController;
use App\Controller\AuthController;
use Slim\Views\PhpRenderer;

$app->get('/',function ($request, $response, array $args){
    $home = new HomeController();
    $renderer = new PhpRenderer('../src/Vue');
    $response->getBody()->write($home->home());
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
    $html = var_export($data, true);
    $response->getBody()->write($html);
    return $response;
});