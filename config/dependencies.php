<?
//dependencies.php
use DI\ContainerBuilder;

use Doctrine\Common\Annotations\AnnotationReader;
use Doctrine\Common\Cache\FilesystemCache;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\Mapping\Driver\AnnotationDriver;

//Nommer la fonction ?
return function (ContainerBuilder $containerBuilder) {
$containerBuilder->addDefinitions([
         EntityManagerInterface::class => function (ContainerInterface $c): EntityManager {
        $doctrineSettings = $c->get('settings')['doctrine'];

        $config = Setup::createAnnotationMetadataConfiguration(
            $doctrineSettings['metadata_dirs'],
            $doctrineSettings['dev_mode']
        );

        $config->setMetadataDriverImpl(
            new AnnotationDriver(
                new AnnotationReader,
                $doctrineSettings['metadata_dirs']
            )
        );

        $config->setMetadataCacheImpl(
            new FilesystemCache($doctrineSettings['cache_dir'])
        );

        return EntityManager::create($doctrineSettings['connection'], $config);
    }
]);
}       

?>