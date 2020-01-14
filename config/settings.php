<?php

use Monolog\Logger;

return [
    'settings' => [
        'displayErrorDetails' => true, // Should be set to false in production
        'logger' => [
            'name' => 'slim-app',
            'path' => isset($_ENV['docker']) ? 'php://stdout' : 'var/logs/app.log',
            'level' => Logger::DEBUG,
        ],
    ],
    'doctrine' => [
        'dev_mode' => true,
        'cache_dir' => 'var/cache/doctrine',
        'metadata_dirs' => [
            'src/Models/User/Entity'
        ],
        'connection' => [
            'url' => 'mysql://admin:secret@mysql:3306/slim',
            'driver' => 'pdo_mysql',
            'host' => 'localhost',
            'port' => 8989,
            'dbname' => 'slim',
            'user' => 'root',
            'password' => '',
            'charset' => 'utf8'
        ]
    ]
];