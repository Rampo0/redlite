<?php
declare(strict_types=1);

namespace Redlite\Modules\Post;

use Phalcon\Di\DiInterface;
use Phalcon\Loader;
use Phalcon\Mvc\View;
use Phalcon\Mvc\View\Engine\Php as PhpEngine;
use Phalcon\Mvc\ModuleDefinitionInterface;
use Redlite\Modules\Post\Services\CreatePostService;
use Redlite\Modules\Post\Services\GetAllPostService;
use Redlite\Modules\Post\Services\DeletePostService;
use Redlite\Modules\Post\Services\UpdatePostService;
use Redlite\Modules\Post\Services\AddRatingService;
use Redlite\Modules\Post\Services\UnrateService;
use Redlite\Modules\Post\InMemory\PostRepository;
use Redlite\Modules\Post\InMemory\SqlPostRepository;

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
            'Redlite\Modules\Post\Controllers' => __DIR__ . '/presentation/controllers/',
            'Redlite\Modules\Post\Models' => __DIR__ . '/application/domain/models/',
            'Redlite\Modules\Post\Exceptions' => __DIR__ . '/application/domain/exceptions/',
            'Redlite\Modules\Post\Requests' => __DIR__ . '/application/requests/',
            'Redlite\Modules\Post\Responses' => __DIR__ . '/application/responses/',
            'Redlite\Modules\Post\Forms' => __DIR__ . '/application/domain/forms/',
            'Redlite\Modules\Post\Repository' => __DIR__ . '/application/domain/repository/',
            'Redlite\Modules\Post\Services' => __DIR__ . '/application/services/',
            'Redlite\Modules\Post\InMemory' => __DIR__ . '/infrastructure/persistence/',
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


        // register service here

        $di->setShared('createPostService', function(){
            return new CreatePostService(new SqlPostRepository($this->get('db')));
        });

        $di->setShared('deletePostService', function(){
            return new DeletePostService(new SqlPostRepository($this->get('db')));
        });

        $di->setShared('updatePostService', function(){
            return new UpdatePostService(new SqlPostRepository($this->get('db')));
        });

        $di->setShared('addRatingService', function(){
            return new AddRatingService(new SqlPostRepository($this->get('db')));
        });

        $di->setShared('unrateService', function(){
            return new UnrateService(new SqlPostRepository($this->get('db')));
        });

        $di->setShared('getAllPostService', function(){
            return new GetAllPostService(new SqlPostRepository($this->get('db')));
        });

        // register events here

        // ex
        // DomainEventPublisher::instance()->subscribe(new SendRatingNotificationService($di->get('swiftMailer')));

    }
}
