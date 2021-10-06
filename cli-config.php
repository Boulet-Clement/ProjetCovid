<?php

use Slim\Factory\AppFactory;
use DI\Container;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\Console\ConsoleRunner;
use DI\ContainerBuilder;
use Doctrine\ORM\Tools\Console\Helper\EntityManagerHelper;
use Symfony\Component\Console\Helper\HelperSet;

require __DIR__ . '/vendor/autoload.php';

require __DIR__ . '/config/bootstrap.php';

// Instantiate PHP-DI ContainerBuilder
$containerBuilder = new ContainerBuilder();

// Set up settings
$settings = require __DIR__ . './settings.php';
$settings($containerBuilder);

// Set up dependencies
$dependencies = require __DIR__ . './dependencies.php';
$dependencies($containerBuilder);


// Build PHP-DI Container instance
$container = $containerBuilder->build();

// Instantiate the app


return ConsoleRunner::createHelperSet($container[EntityManager::class]);



//$app = \DI\Bridge\Slim\Bridge::create($container);

