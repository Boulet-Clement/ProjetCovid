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

require __DIR__ . '/../config/routes.php';

$app->run();