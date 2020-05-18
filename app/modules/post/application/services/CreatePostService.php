<?php


namespace Redlite\Modules\Post\Services;

use Redlite\Modules\Post\Models\Post;
use Redlite\Modules\Post\InMemory\PostRepository;

class CreatePostService{

    private $repository;

    public function __construct(PostRepository $repository){
        $this->repository = $repository;
    }

    public function execute($user_id, $title, $description ,$file){
        try{
            $newPost = Post::createPost($user_id , $title, $description , $file);
            $this->repository->create($newPost);
        }catch (\Exception $exception){
            throw new \Exception();
        }
        
    }

}


?>