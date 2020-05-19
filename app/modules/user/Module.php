<?php
declare(strict_types=1);

namespace Redlite\Modules\User;

use Phalcon\Di\DiInterface;
use Phalcon\Loader;
use Phalcon\Mvc\View;
use Phalcon\Mvc\View\Engine\Php as PhpEngine;
use Phalcon\Mvc\ModuleDefinitionInterface;
use Redlite\Modules\User\Services\RegisterService;
use Redlite\Modules\User\Services\LoginService;
use Redlite\Modules\User\InMemory\UserRepository;

class Module implements ModuleDefinitionInterface
{
    /**
     * Registers an autoloader related to the module
     *
     * @param DiInterface $di
     */
    public function registerAutoloaders(DiInterface $di = null)
    {
        $loader = new Loader();

        $loader->registerNamespaces([
            'Redlite\Modules\User\Controllers' => __DIR__ . '/presentation/controllers/',
            'Redlite\Modules\User\Models' => __DIR__ . '/application/domain/models/',
            'Redlite\Modules\User\Forms' => __DIR__ . '/application/domain/forms/',
            'Redlite\Modules\User\Repository' => __DIR__ . '/application/domain/repository/',
            'Redlite\Modules\User\Services' => __DIR__ . '/application/services/',
            'Redlite\Modules\User\InMemory' => __DIR__ . '/infrastructure/persistence/',
        ]);

        $loader->register();
    }

    /**
     * Registers services related to the module
     *
     * @param DiInterface $di
     */
    public function registerServices(DiInterface $di)
    {
        /**
         * Setting up the view component
         */
        $di->set('view', function () {
            $view = new View();
            $view->setDI($this);
            $view->setViewsDir(__DIR__ . '/views/');

            $view->registerEngines([
                '.volt'  => 'voltShared',
                '.phtml' => PhpEngine::class
            ]);

            return $view;
        });

        $di->setShared('registerService', function(){
            return new RegisterService(new UserRepository);
        });

        $di->setShared('loginService', function(){
            return new LoginService(new UserRepository);
        });

    }
}
