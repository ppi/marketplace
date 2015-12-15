<?php

defined('DS')           || define('DS', DIRECTORY_SEPARATOR);

if (!file_exists($path = dirname(__DIR__) . '/vendor/autoload.php')) {
    die('Unable to find composer generated file at: ' . $path);
}

$loader = require $path;

// Adding PPI autoloader so modules may add themself to the autoload process on-the-fly
PPI\Framework\Autoload::config(array(
    'loader'    => $loader
));
PPI\Framework\Autoload::register();

return $loader;