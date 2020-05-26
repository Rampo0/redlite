<?php
declare(strict_types=1);

namespace Redlite\Modules\Comment;

use Phalcon\Di\DiInterface;
use Phalcon\Loader;
use Phalcon\Mvc\View;
use Phalcon\Mvc\View\Engine\Php as PhpEngine;
use Phalcon\Mvc\ModuleDefinitionInterface;

use Redlite\Modules\Comment\Services\CreateCommentService;
use Redlite\Modules\Comment\Services\GetCommentService;
use Redlite\Modules\Comment\Services\DeleteCommentService;
use Redlite\Modules\Comment\Services\GetCommentByIdService;
use Redlite\Modules\Comment\Services\EditCommentService;
use Redlite\Modules\Comment\Services\GetPostByIdService;
use Redlite\Modules\Comment\Services\RateCommentService;
use Redlite\Modules\Comment\Services\UnrateCommentService;

use Redlite\Modules\Comment\InMemory\CommentRepository;
use Redlite\Modules\Comment\InMemory\SQLCommentRepository;
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
            'Redlite\Modules\Comment\Controllers' => __DIR__ . '/presentation/controllers/',
            'Redlite\Modules\Comment\Models' => __DIR__ . '/application/domain/models/',
            'Redlite\Modules\Comment\Forms' => __DIR__ . '/application/domain/forms/',
            'Redlite\Modules\Comment\Repository' => __DIR__ . '/application/domain/repository/',
            'Redlite\Modules\Comment\Services' => __DIR__ . '/application/services/',
            'Redlite\Modules\Comment\InMemory' => __DIR__ . '/infrastructure/persistence/',
            'Redlite\Modules\Post\Models' => __DIR__ . '/../post/application/domain/models/',
            'Redlite\Modules\Post\InMemory' => __DIR__ . '/../post/infrastructure/persistence/',
            'Redlite\Modules\Post\Repository' => __DIR__ . '/../post/application/domain/repository/',
            'Redlite\Modules\Subredlite\Models' => __DIR__ . '/../subredlite/application/domain/models/',
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
            return new CreateCommentService(new SQLCommentRepository($this->get('db')));
        });

        $di->setShared('deleteCommentService', function(){
            return new DeleteCommentService(new SQLCommentRepository($this->get('db')));
        });

        $di->setShared('getCommentService', function(){
            return new GetCommentService(new SQLCommentRepository($this->get('db')));
        });

        $di->setShared('getCommentByIdService', function(){
            return new GetCommentByIdService(new SQLCommentRepository($this->get('db')));
        });

        $di->setShared('editCommentService', function(){
            return new EditCommentService(new SQLCommentRepository($this->get('db')));
        });

        $di->setShared('rateCommentService', function(){
            return new RateCommentService(new SQLCommentRepository($this->get('db')));
        });

        $di->setShared('unrateCommentService', function(){
            return new UnrateCommentService(new SQLCommentRepository($this->get('db')));
        });

        $di->setShared('getPostByIdService', function(){
            return new GetPostByIdService(new SQLPostRepository($this->get('db')));
        });

        // register events here

        // ex
        // DomainEventPublisher::instance()->subscribe(new SendRatingNotificationService($di->get('swiftMailer')));

    }
}
