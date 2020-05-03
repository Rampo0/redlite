<?php


namespace Redlite\Modules\Post\Services;

use Redlite\Modules\Post\Models\Post;
use Redlite\Modules\Post\InMemory\PostRepository;

class CreatePostService{

    private $repository;

    public function __construct(PostRepository $repository){
        $this->repository = $repository;
    }

    public function execute($description ,$file){
        try{
            $newPost = Post::createPost($description , $file);
            $this->repository->create($newPost);
        }catch (\Exception $exception){
            throw new \Exception();
        }
        
    }

}


?>