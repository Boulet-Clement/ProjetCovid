<?php

use App\Controller\HomeController;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;
require __DIR__ . '/../src/Controller/HomeController.php';

require __DIR__ . '/../vendor/autoload.php';

$app = AppFactory::create();

$app->get('/',function ($request, $response, array $args){
    $home = new HomeController();
    $response->getBody()->write($home->home());
    return $response;
});
$app->run();