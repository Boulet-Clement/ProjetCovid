<?php
//https://stackoverflow.com/questions/59639893/how-to-use-doctrine-with-slim-framework-4

use Slim\Factory\AppFactory;
use DI\Container;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;
use DI\ContainerBuilder;

require __DIR__ . '/../vendor/autoload.php';

require __DIR__ . '/../src/PhpRenderer.php';
$app = \DI\Bridge\Slim\Bridge::create();

// Instantiate PHP-DI ContainerBuilder
$containerBuilder = new ContainerBuilder();

// Set up settings
$settings = require __DIR__ . '/../config/settings.php';
$settings($containerBuilder);

// Set up dependencies
function test(ContainerBuilder $containerBuilder) {
    $containerBuilder->addDefinitions(
    [
        EntityManager::class => function (ContainerInterface $container): EntityManager {
            $settings = $container->get('settings');

            $config = Setup::createAnnotationMetadataConfiguration(
                $settings['doctrine']['metadata_dirs'],
                $settings['doctrine']['dev_mode']
            );

            $config->setMetadataDriverImpl(
                new AnnotationDriver(
                    new AnnotationReader,
                    $settings['doctrine']['metadata_dirs']
                )
            );
            $config->setMetadataCacheImpl(
                new FilesystemCache(
                    $settings['doctrine']['cache_dir']
                )
            );
            return EntityManager::create(
                $settings['doctrine']['connection'],
                $config
            );
        },
    ]);
};     
test($containerBuilder);

// Build PHP-DI Container instance
$container = $containerBuilder->build();

// Instantiate the app
AppFactory::setContainer($container);
$app = AppFactory::create();


// Set container to create App with on AppFactory

//$app = \DI\Bridge\Slim\Bridge::create($container);

require __DIR__ . '/../config/routes.php';

$app->run();