<?php

use Phalcon\Loader;

$loader = new Loader();

/**
 * Register Namespaces
 */
$loader->registerNamespaces([
    'Redlite\Models' => APP_PATH . '/common/models/',
    'Redlite'        => APP_PATH . '/common/library/',
]);

/**
 * Register module classes
 */
$loader->registerClasses([
    'Redlite\Modules\Frontend\Module' => APP_PATH . '/modules/frontend/Module.php',
    'Redlite\Modules\Cli\Module'      => APP_PATH . '/modules/cli/Module.php'
]);

$loader->register();
