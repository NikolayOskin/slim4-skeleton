<?php

use Monolog\Logger;

return [
    'settings' => [
        'displayErrorDetails' => false, // Should be set to false in production
        'logger' => [
            'name' => 'slim-app',
            'path' => isset($_ENV['docker']) ? 'php://stdout' : 'var/logs/app.log',
            'level' => Logger::DEBUG,
        ],
        'auth' => [
            'refresh_token_expire_interval' => 'P1M'
        ],
    ],
    'doctrine' => [
        'dev_mode' => true,
        'cache_dir' => 'var/cache/doctrine',
        'metadata_dirs' => [
            'src/Models/User/Entity',
            'src/Models/Auth/Entity',
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