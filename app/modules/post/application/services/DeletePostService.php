<?php


namespace Redlite\Modules\Post\Services;

use Redlite\Modules\Post\Models\Post;
use Redlite\Modules\Post\Models\PostId;
use Redlite\Modules\Post\InMemory\PostRepository;
use Redlite\Modules\Post\InMemory\SqlPostRepository;
use Redlite\Modules\Post\Requests\CreatePostRequest;
use Redlite\Modules\Post\Responses\DeletePostResponse;
use Redlite\Models\GeneralResponse;

class DeletePostService{

    private $repository;

    public function __construct(SqlPostRepository $repository){
        $this->repository = $repository;
    }

    public function execute($post_id){
        try{
            $reponse = $this->repository->delete(new PostId($post_id));

            return new DeletePostResponse($response , "Post deleted successfully !!");
        }catch (\Exception $exception){
            return new DeletePostResponse($exception , $exception->getMessage(), 400 , true);
        }
    }

}


?>