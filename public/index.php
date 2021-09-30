<?php

use Slim\Factory\AppFactory;
use DI\Container;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;


require __DIR__ . '/../vendor/autoload.php';

require __DIR__ . '/../src/PhpRenderer.php';

$container = new Container();

// Set container to create App with on AppFactory
AppFactory::setContainer($container);

$app = AppFactory::create();

require __DIR__ . '/../config/routes.php';

$app->run();