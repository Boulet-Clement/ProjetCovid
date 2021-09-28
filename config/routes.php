<?php
use App\Controller\HomeController;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;
use Slim\Views\PhpRenderer;

$app->get('/',function ($request, $response, array $args){
    $home = new HomeController();
    $renderer = new PhpRenderer('../src/Vue');
    $response->getBody()->write($home->home());
    return $renderer->render($response,'homeVue.php', $args);
});