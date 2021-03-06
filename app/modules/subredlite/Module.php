<?php
declare(strict_types=1);

namespace Redlite\Modules\Subredlite;

use Phalcon\Di\DiInterface;
use Phalcon\Loader;
use Phalcon\Mvc\View;
use Phalcon\Mvc\View\Engine\Php as PhpEngine;
use Phalcon\Mvc\ModuleDefinitionInterface;
use Redlite\Modules\Subredlite\Services\CreateSubRedliteService;
use Redlite\Modules\Subredlite\Services\UpdateSubRedliteService;
use Redlite\Modules\Subredlite\Services\CreateAnnouncementService;
use Redlite\Modules\Subredlite\Services\GetAllSubRedliteService;
use Redlite\Modules\Subredlite\Services\GetSubRedliteService;
use Redlite\Modules\Subredlite\Services\AddModsService;
use Redlite\Modules\Subredlite\Services\LockCommentService;
use Redlite\Modules\Subredlite\Services\ForceDeleteCommentService;
use Redlite\Modules\Subredlite\Services\RemoveModAccessService;
use Redlite\Modules\Subredlite\InMemory\SubRedliteRepository;

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
            'Redlite\Modules\Subredlite\Controllers' => __DIR__ . '/presentation/controllers/',
            'Redlite\Modules\Subredlite\Models' => __DIR__ . '/application/domain/models/',
            'Redlite\Modules\Subredlite\Exceptions' => __DIR__ . '/application/domain/exceptions/',
            'Redlite\Modules\Subredlite\Requests' => __DIR__ . '/application/domain/Requests/',
            'Redlite\Modules\Subredlite\Responses' => __DIR__ . '/application/domain/Responses/',
            'Redlite\Modules\Subredlite\Forms' => __DIR__ . '/application/domain/forms/',
            'Redlite\Modules\Subredlite\Repository' => __DIR__ . '/application/domain/repository/',
            'Redlite\Modules\Subredlite\Services' => __DIR__ . '/application/services/',
            'Redlite\Modules\Subredlite\InMemory' => __DIR__ . '/infrastructure/persistence/',
            'Redlite\Modules\Post\Models' => __DIR__ . '/../post/application/domain/models/'
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
        $di->set('view', function()
        {
            $view = new View();
            $view->setDI($this);
            $view->setViewsDir(__DIR__ . '/views/');

            $view->registerEngines([
                '.volt'  => 'voltShared',
                '.phtml' => PhpEngine::class
            ]);

            return $view;
        });


        $di->setShared('createSubRedliteService', function()
        {
            return new CreateSubRedliteService(new SubRedliteRepository($this->get('db')));
        });

        $di->setShared('updateSubRedliteService', function()
        {
            return new UpdateSubRedliteService(new SubRedliteRepository($this->get('db')));
        });

        $di->setShared('createAnnouncementService', function()
        {
            return new CreateAnnouncementService(new SubRedliteRepository($this->get('db')));
        });

        $di->setShared('getAllSubRedliteService', function()
        {
            return new GetAllSubRedliteService(new SubRedliteRepository($this->get('db')));
        });

        $di->setShared('getSubRedliteService', function()
        {
            return new GetSubRedliteService(new SubRedliteRepository($this->get('db')));
        });

        $di->setShared('addModsService', function()
        {
            return new AddModsService(new SubRedliteRepository($this->get('db')));
        });

        $di->setShared('removeModAccessService', function()
        {
            return new RemoveModAccessService(new SubRedliteRepository($this->get('db')));
        });

        $di->setShared('lockCommentService', function()
        {
            return new LockCommentService(new SubRedliteRepository($this->get('db')));
        });

        $di->setShared('forceDeleteCommentService', function()
        {
            return new ForceDeleteCommentService(new SubRedliteRepository($this->get('db')));
        });
    }
}
