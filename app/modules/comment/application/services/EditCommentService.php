<?php


namespace Redlite\Modules\Comment\Services;

use Redlite\Modules\Comment\Models\Comment;
use Redlite\Modules\Comment\Models\CommentMapper;
use Redlite\Modules\Comment\Models\Ratingcom;
use Redlite\Modules\Comment\InMemory\SQLCommentRepository;


class EditCommentService{

    private $repository;

    public function __construct(SQLCommentRepository $repository){
        $this->repository = $repository;
    }

    public function execute($comment_id, $content){
        try{
            $this->repository->update($comment_id, $content);
        }catch (\Exception $exception){
            throw new \Exception();
        }
        return null;
        
    }
}


?>