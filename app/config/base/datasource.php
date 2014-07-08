<?php

$connections = array();

$connections['main'] = array(

    'library'    => 'doctrine_dbal',
    'fetch_mode' => \PDO::FETCH_ASSOC,

    'driver'     => 'pdo_mysql',
    'hostname'   => 'localhost',
    'database'   => 'ppi_marketplace',
    'username'   => 'root',
    'password'   => '',

    'charset'    => 'utf8',
    'collation'  => 'utf8_unicode_ci',
    'prefix'     => ''
);

return $connections; // Very important you must return the connections variable from this script
