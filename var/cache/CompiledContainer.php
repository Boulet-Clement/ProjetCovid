<?php
/**
 * This class has been auto-generated by PHP-DI.
 */
class CompiledContainer extends DI\CompiledContainer{
    const METHOD_MAPPING = array (
  'Doctrine\\ORM\\EntityManager' => 'get1',
  'settings' => 'get2',
  'subEntry1' => 'get3',
  'subEntry2' => 'get4',
  'subEntry3' => 'get5',
);

    protected function get1()
    {
        return $this->resolveFactory(static function (\Psr\Container\ContainerInterface $container): \Doctrine\ORM\EntityManager{
            $settings = $container->get('settings');
            $config = \Doctrine\ORM\Tools\Setup::createAnnotationMetadataConfiguration(
                $settings['doctrine']['metadata_dirs'],
                $settings['doctrine']['dev_mode']
            );
            $config->setMetadataDriverImpl(
                new \Doctrine\ORM\Mapping\Driver\AnnotationDriver(
                    new \Doctrine\Common\Annotations\AnnotationReader,
                    $settings['doctrine']['metadata_dirs']
                )
            );
            $config->setMetadataCacheImpl(
                new \Twig\Cache\FilesystemCache(
                    $settings['doctrine']['cache_dir']
                )
            );
            return \Doctrine\ORM\EntityManager::create(
                $settings['doctrine']['connection'],
                $config
            );
        }, 'Doctrine\\ORM\\EntityManager');
    }

    protected function get4()
    {
        return [
            0 => 'C:\\laragon\\Projets\\ProjetCovid\\config/../src/Domain/',
        ];
    }

    protected function get5()
    {
        return [
            'driver' => 'pdo_mysql',
            'host' => 'localhost',
            'port' => 3306,
            'dbname' => 'projetCovid',
            'user' => 'root',
            'password' => '',
        ];
    }

    protected function get3()
    {
        return [
            'dev_mode' => true,
            'cache_dir' => 'C:\\laragon\\Projets\\ProjetCovid\\config/../var/cache/doctrine',
            'metadata_dirs' => $this->get4(),
            'connection' => $this->get5(),
        ];
    }

    protected function get2()
    {
        return [
            'doctrine' => $this->get3(),
        ];
    }

}
