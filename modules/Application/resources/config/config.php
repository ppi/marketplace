<?php
$config = array();

$config['module'] = array();
$config['module']['screenshots_public_dir'] = realpath('./public/screenshots');
$config['module']['thumbnails_public_dir']  = realpath('./public/thumbs');
$config['module']['thumbnails_width']  = '150';

return $config;
