<?php


namespace Redlite\Modules\Post\Services;

use Redlite\Modules\Post\Models\Post;
use Redlite\Modules\Post\Models\PostId;
use Redlite\Modules\Post\InMemory\PostRepository;
use Redlite\Modules\Post\InMemory\SqlPostRepository;
use Redlite\Modules\Post\Requests\UpdatePostRequest;
use Redlite\Modules\Post\Responses\UpdatePostResponse;

class UpdatePostService{

    private $repository;

    public function __construct(SqlPostRepository $repository){
        $this->repository = $repository;
    }

    public function execute(UpdatePostRequest $request){
        try{
            
            $postToEdit = $this->repository->findPostById(new PostId($request->post_id()));
         
            if($request->filename() != ""){
                $postToEdit['file'] = $request->filename();
            }

            $postToEdit['title'] = $request->title();
            $postToEdit['description'] = $request->description();
            $response = $this->repository->update($postToEdit);
            $request->saveFile();

            return new UpdatePostResponse($response , "Post updated successfully !!");
        }catch (\Exception $exception){
            return new UpdatePostResponse($exception , $exception->getMessage(), 400 , true);
        }
        
    }

}


?>