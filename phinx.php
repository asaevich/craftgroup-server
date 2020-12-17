<?php

require 'config/database.php';

return
[
    'paths' => [
        'migrations' => 'db/migrations',
        'seeds' => 'db/seeds'
    ],
    'environments' => [
        'default_migration_table' => 'phinxlog',
        'default_environment' => 'development',
        'development' => [
            'adapter' => DB_DRIVER,
            'host' => DB_HOST,
            'name' => DB_NAME,
            'user' => DB_USERNAME,
            'pass' => DB_PASSWORD,
            'port' => DB_PORT,
        ],
    ],
    'version_order' => 'creation'
];
