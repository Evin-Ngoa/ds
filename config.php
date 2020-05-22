<?php
$ini_config = parse_ini_file('config.ini');
return [
    'mysql' => [
        'driver' => 'mysql',
        'host' => $ini_config['DB_MYSQL_SERVER'],
        'port' => $ini_config['DB_MYSQL_PORT'],
        'database' => $ini_config['DB_MYSQL_NAME'],
        'username' => $ini_config['DB_MYSQL_USER'],
        'password' => $ini_config['DB_MYSQL_PASSWORD'],
    ],

    'pgsql' => [
        'driver' => 'pgsql',
        'host' => $ini_config['DB_POSTGRES_SERVER'],
        'port' => $ini_config['DB_POSTGRES_PORT'],
        'database' => $ini_config['DB_POSTGRES_NAME'],
        'username' => $ini_config['DB_POSTGRES_USER'],
        'password' => $ini_config['DB_POSTGRES_PASSWORD'],
    ]
];