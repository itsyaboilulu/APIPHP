<?php
$settings = [
    'settings' => [
        // Slim Settings
        'determineRouteBeforeAppMiddleware' => false,
        'displayErrorDetails' => true,
        'dispayErrorDetails' => true,
        'db' => [
            'driver' => 'mysql',
            'host' => $constants['sql']['host'],
            'database' => $constants['sql']['database'],
            'username' => $constants['sql']['user'],
            'password' => $constants['sql']['password'],
            'charset'   => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix'    => '',
        ]
    ],
];