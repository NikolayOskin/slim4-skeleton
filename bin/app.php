<?php

use Doctrine\Migrations\Tools\Console\Helper\ConfigurationHelper;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\Console\Helper\EntityManagerHelper;
use Symfony\Component\Console\Application;

require __DIR__ . '/../vendor/autoload.php';

$container = require __DIR__ . '/../config/bootstrap.php';

$cli = new Application('Application console');

$entityManager = $container->get(EntityManager::class);
$connection = $entityManager->getConnection();

$configuration = new \Doctrine\Migrations\Configuration\Configuration($connection);
$configuration->setMigrationsDirectory('src/Data/Migration');
$configuration->setMigrationsNamespace('Api\Data\Migration');

$cli->getHelperSet()->set(new EntityManagerHelper($entityManager), 'em');
$cli->getHelperSet()->set(new ConfigurationHelper($connection, $configuration), 'configuration');

Doctrine\ORM\Tools\Console\ConsoleRunner::addCommands($cli);
Doctrine\Migrations\Tools\Console\ConsoleRunner::addCommands($cli);

$cli->run();