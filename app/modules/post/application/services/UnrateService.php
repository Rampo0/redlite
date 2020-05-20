<?php


namespace Redlite\Modules\Post\Services;

use Redlite\Modules\Post\Models\Post;
use Redlite\Modules\Post\Models\Rating;
use Redlite\Modules\Post\Models\PostId;
use Redlite\Modules\Post\InMemory\PostRepository;
use Redlite\Modules\Post\InMemory\SqlPostRepository;
use Redlite\Modules\Post\Requests\UnrateRequest;
use Redlite\Modules\Post\Responses\UnrateResponse;
use Redlite\Models\GeneralResponse;

class UnrateService{

    private $repository;

    public function __construct(SqlPostRepository $repository){
        $this->repository = $repository;
    }

    public function execute(UnrateRequest $request){
        try{
            $reponse = $this->repository->unrate(new Rating($request->user_id(),null,$request->post_id()));

            return new UnrateResponse($response , "Unrate successfully !!");
        }catch (\Exception $exception){
            return new UnrateResponse($exception , $exception->getMessage(), 400 , true);
        }
    }

}


?>