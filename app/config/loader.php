<?php

use Phalcon\Loader;

$loader = new Loader();

/**
 * Register Namespaces
 */
$loader->registerNamespaces([
    'Redlite\Models' => APP_PATH . '/common/models/',
    'Redlite\Events' => APP_PATH . '/common/events/',
    'Redlite'        => APP_PATH . '/common/library/',
]);

/**
 * Register module classes
 */
$loader->registerClasses([
    'Redlite\Modules\Frontend\Module' => APP_PATH . '/modules/frontend/Module.php',
    'Redlite\Modules\Cli\Module'      => APP_PATH . '/modules/cli/Module.php',
    'Redlite\Modules\Post\Module' => APP_PATH . '/modules/post/Module.php',
    'Redlite\Modules\Subredlite\Module' => APP_PATH . '/modules/subredlite/Module.php',
    'Redlite\Modules\User\Module' => APP_PATH . '/modules/user/Module.php',
    'Redlite\Modules\Comment\Module' => APP_PATH . '/modules/comment/Module.php'
]);

$loader->register();
