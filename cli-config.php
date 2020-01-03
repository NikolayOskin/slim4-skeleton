<?php

use Doctrine\Common\Annotations\AnnotationReader;
use Doctrine\Common\Cache\FilesystemCache;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Mapping\Driver\AnnotationDriver;
use Doctrine\ORM\Tools\Console\ConsoleRunner;
use Doctrine\ORM\Tools\Setup;

require __DIR__ . './vendor/autoload.php';

$settings = require __DIR__ . './config/settings.php';

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

$em = EntityManager::create(
    $settings['doctrine']['connection'],
    $config
);

$helperSet = ConsoleRunner::createHelperSet($em);
ConsoleRunner::run($helperSet, []);

return $em;