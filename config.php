<?php
$ini = parse_ini_file('config.ini');
return [
    'mysql' => [
        'driver' => 'mysql',
        'host' => $ini['DB_MYSQL_SERVER'],
        'port' => $ini['DB_MYSQL_PORT'],
        'database' => $ini['DB_MYSQL_NAME'],
        'username' => $ini['DB_MYSQL_USER'],
        'password' => $ini['DB_MYSQL_PASSWORD'],
    ],

    'pgsql' => [
        'driver' => 'pgsql',
        'host' => $ini['DB_POSTGRES_SERVER'],
        'port' => $ini['DB_POSTGRES_PORT'],
        'database' => $ini['DB_POSTGRES_NAME'],
        'username' => $ini['DB_POSTGRES_USER'],
        'password' => $ini['DB_POSTGRES_PASSWORD'],
    ]
];