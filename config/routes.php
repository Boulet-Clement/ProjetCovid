<?php
use App\Controller\HomeController;
use Slim\Views\PhpRenderer;

$app->get('/',function ($request, $response, array $args){
    $home = new HomeController();
    $renderer = new PhpRenderer('../src/Vue');
    $response->getBody()->write($home->home());
    return $renderer->render($response,'homeVue.php', $args);
});