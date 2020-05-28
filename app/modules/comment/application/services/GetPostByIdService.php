<?php


namespace Redlite\Modules\Comment\Services;

use Redlite\Modules\Post\Models\Post;
use Redlite\Modules\Post\Models\PostId;
use Redlite\Modules\Post\InMemory\SQLPostRepository;


class GetPostByIdService{

    private $repository;

    public function __construct(SQLPostRepository $repository){
        $this->repository = $repository;
    }

    public function execute($post_id){
        try{
            $post = $this->repository->findPostById(new PostId($post_id));
            return $post;
        }catch (\Exception $exception){
            throw new \Exception();
        }
        return null;
        
    }
}


?>