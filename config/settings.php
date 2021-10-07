<?php
declare(strict_types=1);
// https://www.loiclaurent.com/posts/developpement-web/utiliser-doctrine-dans-le-framework-php-slim-4/
use DI\ContainerBuilder; 


return function (ContainerBuilder $containerBuilder) {
// Global Settings Object
$containerBuilder->addDefinitions([
'settings' => [
   'doctrine' => [
            'dev_mode' => true,
            'cache_dir' => __DIR__.'/../var/cache/doctrine',
            'metadata_dirs' => [__DIR__.'/../src/Model/'],
            'connection' => [
                'driver' => 'pdo_mysql',
                'host' => 'localhost',
                'port' => 3306,
                'dbname' => 'projetCovid',
                'user' => 'root',
                'password' => '',
                ]
            ]
        ]
    ]);
};
/*
define('APP_ROOT', __DIR__);

return [
    'settings' => [
        'displayErrorDetails' => true,
        'determineRouteBeforeAppMiddleware' => false,

        'doctrine' => [
            // if true, metadata caching is forcefully disabled
            'dev_mode' => true,

            // path where the compiled metadata info will be cached
            // make sure the path exists and it is writable
            'cache_dir' => APP_ROOT . '/var/doctrine',

            // you should add any other path containing annotated entity classes
            'metadata_dirs' => [APP_ROOT . '/src/Domain'],

            'connection' => [
                'driver' => 'pdo_mysql',
                'host' => 'localhost',
                'port' => 3306,
                'dbname' => 'projetCovid',
                'user' => 'root',
                'password' => '',
                'charset' => 'utf8'
            ]
        ]
    ]
];
/*
use DI\ContainerBuilder;
use Slim\Factory\AppFactory;

define('APP_ROOT', __DIR__);

$containerBuilder->addDefitions([
    'settings' => [
        'displayErrorDetails' => true,
        'determineRouteBeforeAppMiddleware' => false,

        'doctrine' => [
            // if true, metadata caching is forcefully disabled
            'dev_mode' => true,

            // path where the compiled metadata info will be cached
            // make sure the path exists and it is writable
            'cache_dir' => APP_ROOT . '/var/doctrine',

            // you should add any other path containing annotated entity classes
            'metadata_dirs' => [APP_ROOT . '/src/Domain'],

            'connection' => [
                'driver' => 'pdo_mysql',
                'host' => 'localhost',
                'port' => 3306,
                'dbname' => 'projetCovid',
                'user' => 'root',
                'password' => '',
                'charset' => 'utf-8'
            ]
        ]
    ]
]);*/
