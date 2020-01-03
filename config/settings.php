<?php

use Monolog\Logger;

return [
    'settings' => [
        'displayErrorDetails' => true, // Should be set to false in production
        'logger' => [
            'name' => 'slim-app',
            'path' => isset($_ENV['docker']) ? 'php://stdout' : __DIR__ . '/../logs/app.log',
            'level' => Logger::DEBUG,
        ],
    ],
    'doctrine' => [
        'dev_mode' => true,
        'cache_dir' => __DIR__ . './../var/cache/doctrine',
        'metadata_dirs' => [
            __DIR__ . './../src/Models/User/Entity'
        ],
        'connection' => [
            'driver' => 'pdo_mysql',
            'host' => 'localhost',
            'port' => 3306,
            'dbname' => 'slim',
            'user' => 'root',
            'password' => '',
            'charset' => 'utf8'
        ]
    ]
];