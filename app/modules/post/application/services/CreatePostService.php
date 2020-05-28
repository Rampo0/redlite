<?php


namespace Redlite\Modules\Post\Services;

use Redlite\Modules\Post\Models\Post;
use Redlite\Modules\Post\InMemory\PostRepository;
use Redlite\Modules\Post\InMemory\SqlPostRepository;
use Redlite\Modules\Post\Requests\CreatePostRequest;
use Redlite\Modules\Post\Responses\CreatePostResponse;

class CreatePostService{

    private $repository;

    public function __construct(SqlPostRepository $repository){
        $this->repository = $repository;
    }

    public function execute(CreatePostRequest $request){
        try{
            $newPost = Post::createPost($request->user_id() , $request->title(), $request->description() , $request->filename());
            $response = $this->repository->create($newPost);
            $request->saveFile();

            return new CreatePostResponse($response , "Post created successfully !!");
        }catch (\Exception $exception){
            return new CreatePostResponse($exception , $exception->getMessage(), 400 , true);
        }
        
    }

}


?>