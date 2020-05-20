<?php


namespace Redlite\Modules\Post\Services;

use Redlite\Modules\Post\Models\Post;
use Redlite\Modules\Post\Models\PostId;
use Redlite\Modules\Post\InMemory\PostRepository;
use Redlite\Modules\Post\InMemory\SqlPostRepository;
use Redlite\Modules\Post\Requests\AddRatingRequest;
use Redlite\Modules\Post\Responses\AddRatingResponse;

class AddRatingService{

    private $repository;

    public function __construct(SqlPostRepository $repository){
        $this->repository = $repository;
    }

    public function execute(AddRatingRequest $request){
        try{

            $ratings = $this->repository->getRatingByPostId(new PostId($request->post_id()));
            $newRating = Post::addRating($ratings , $request->user_id(), $request->rating() , $request->post_id());
            $response = $this->repository->addRating($newRating);

            return new AddRatingResponse($response , "rating successfully !!");
        }catch (\Exception $exception){
            return new AddRatingResponse($exception , $exception->getMessage(), 400 , true);
        }
        
    }

}


?>