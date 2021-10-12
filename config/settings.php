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
            ],
        'twig' => [
            'paths' => [
                __DIR__ .'/../src/Vue'
                ],
            'options' => [
                'cache_enabled' => false,
                'cache_path' => __DIR__ . '/../var/twig',
                ]
            ]
        ]
    ]);
};
