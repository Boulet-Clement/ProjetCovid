<?php 
declare(strict_types=1);

use DI\ContainerBuilder;

use Psr\Container\ContainerInterface;

use Doctrine\Common\Annotations\AnnotationReader;
use Doctrine\Common\Cache\FileSystemeCache;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Mapping\Driver\AnnotationDriver;
use Doctrine\ORM\Tools\Setup;
use Twig\Cache\FilesystemCache;

return function (ContainerBuilder $containerBuilder){
    $containerBuilder->addDefinitions([
        EntityManager::class => function (ContainerInterface $container): EntityManager{
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