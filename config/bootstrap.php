<?php

use DI\ContainerBuilder;
use Slim\Factory\AppFactory;

require __DIR__ . '/../vendor/autoload.php';

$containerBuilder = new ContainerBuilder();
//$containerBuilder->enableCompilation(__DIR__ . '/../var/cache');

$containerBuilder->addDefinitions(require __DIR__ . '/settings.php');
$containerBuilder->addDefinitions(require __DIR__ . '/container.php');
$containerBuilder->addDefinitions(require __DIR__ . '/model.php');
$container = $containerBuilder->build();

return $container;