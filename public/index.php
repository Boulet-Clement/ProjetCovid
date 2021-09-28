<?php

use Slim\Factory\AppFactory;
require __DIR__ . '/../src/Controller/HomeController.php';

require __DIR__ . '/../vendor/autoload.php';

require __DIR__ . '/../src/PhpRenderer.php';

$app = AppFactory::create();

require __DIR__ . '/../config/routes.php';

$app->run();