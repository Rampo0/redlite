<?php
declare(strict_types=1);

namespace Redlite\Modules\Comment;

use Phalcon\Di\DiInterface;
use Phalcon\Loader;
use Phalcon\Mvc\View;
use Phalcon\Mvc\View\Engine\Php as PhpEngine;
use Phalcon\Mvc\ModuleDefinitionInterface;
use Redlite\Modules\Post\Services\CreatePostService;
use Redlite\Modules\Post\Services\GetAllPostService;
use Redlite\Modules\Post\InMemory\PostRepository;

use Redlite\Modules\Comment\Services\CreateCommentService;
use Redlite\Modules\Comment\Services\GetCommentService;
use Redlite\Modules\Comment\InMemory\CommentRepository;

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
            'Redlite\Modules\Comment\Controllers' => __DIR__ . '/presentation/controllers/',
            'Redlite\Modules\Comment\Models' => __DIR__ . '/application/domain/models/',
            'Redlite\Modules\Comment\Exceptions' => __DIR__ . '/application/domain/exceptions/',
            'Redlite\Modules\Comment\Requests' => __DIR__ . '/application/domain/Requests/',
            'Redlite\Modules\Comment\Responses' => __DIR__ . '/application/domain/Responses/',
            'Redlite\Modules\Comment\Forms' => __DIR__ . '/application/domain/forms/',
            'Redlite\Modules\Comment\Repository' => __DIR__ . '/application/domain/repository/',
            'Redlite\Modules\Comment\Services' => __DIR__ . '/application/services/',
            'Redlite\Modules\Comment\InMemory' => __DIR__ . '/infrastructure/persistence/',
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

        $di->setShared('createCommentService', function(){
            return new CreateCommentService(new CommentRepository);
        });

        $di->setShared('getCommentService', function(){
            return new GetCommentService(new CommentRepository);
        });

        // register events here

        // ex
        // DomainEventPublisher::instance()->subscribe(new SendRatingNotificationService($di->get('swiftMailer')));

    }
}
