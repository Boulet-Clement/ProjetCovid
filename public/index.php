<?php

use App\Controller\HomeController;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;
use Slim\Views\PhpRenderer;
require __DIR__ . '/../src/Controller/HomeController.php';

require __DIR__ . '/../vendor/autoload.php';

require __DIR__ . '/../src/PhpRenderer.php';


$app = AppFactory::create();


$app->get('/',function ($request, $response, array $args){

    $home = new HomeController();
    $renderer = new PhpRenderer('../src/Vue');
    //$response->getBody()->write($home->home());
    return $renderer->render($response,'home.html.twig', $args);
});
$app->run();