<?php


namespace Redlite\Modules\Comment\Services;

use Redlite\Modules\Comment\Models\Comment;
use Redlite\Modules\Comment\Models\CommentMapper;
use Redlite\Modules\Comment\Models\Ratingcom;
use Redlite\Modules\Comment\InMemory\SQLCommentRepository;


class UnrateCommentService{

    private $repository;

    public function __construct(SQLCommentRepository $repository){
        $this->repository = $repository;
    }

    public function execute($comment_id, $user_id){
        try{
            $this->repository->unrate($comment_id, $user_id);
        }catch (\Exception $exception){
            throw new \Exception();
        }
        return null;
        
    }
}


?>