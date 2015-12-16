<?php
return array(

'modules' => array(
    'Framework',
    'Application',
    'UserModule',
    'PPI\DataSourceModule'
),
'module_listener_options' => array(
    'cache_dir'                => '%app.cache_dir%',
    'config_cache_enabled'     => false,
    'config_cache_key'         => '%app.name%',
    'module_map_cache_enabled' => false,
    'module_map_cache_key'     => '%app.name%',
    'module_paths'      => array(
        './modules',
        './vendor'
    )
),
'framework' => array(
    'templating' => array(
        'engines'     => array('php'),
    ),
    'skeleton_module' => array(
        'path' => './utils/skeleton_module'
    )
),

'datasource' => array(
    'connections' => require __DIR__ . '/datasource.php'
)
);
