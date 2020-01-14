<?php

use DI\ContainerBuilder;

$containerBuilder = new ContainerBuilder();
//$containerBuilder->enableCompilation(__DIR__ . 'var/cache');

$containerBuilder->addDefinitions(require 'config/settings.php');
$containerBuilder->addDefinitions(require 'config/services.php');
$container = $containerBuilder->build();

return $container;