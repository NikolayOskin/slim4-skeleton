<?php

use Doctrine\Common\Annotations\AnnotationReader;
use Doctrine\Common\Cache\FilesystemCache;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Mapping\Driver\AnnotationDriver;
use Doctrine\ORM\Tools\Setup;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Monolog\Processor\UidProcessor;
use Psr\Container\ContainerInterface;
use Psr\Log\LoggerInterface;

return [
    LoggerInterface::class => function (ContainerInterface $c) {
        $settings = $c->get('settings');

        $loggerSettings = $settings['logger'];
        $logger = new Logger($loggerSettings['name']);

        $processor = new UidProcessor();
        $logger->pushProcessor($processor);

        $handler = new StreamHandler($loggerSettings['path'], $loggerSettings['level']);
        $logger->pushHandler($handler);

        return $logger;
    },
    EntityManager::class => function (ContainerInterface $c): EntityManager {
        $settings = $c->get('doctrine');

        $config = Setup::createAnnotationMetadataConfiguration(
            $settings['metadata_dirs'],
            $settings['dev_mode']
        );
        $config->setMetadataDriverImpl(
            new AnnotationDriver(
                new AnnotationReader,
                $settings['metadata_dirs']
            )
        );
        $config->setMetadataCacheImpl(
            new FilesystemCache(
                $settings['cache_dir']
            )
        );

        $em = EntityManager::create(
            $settings['connection'],
            $config
        );

        return $em;
    }
];