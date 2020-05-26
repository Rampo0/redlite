<?php


namespace Redlite\Modules\Comment\Services;

use Redlite\Modules\Comment\Models\Comment;
use Redlite\Modules\Comment\Models\CommentMapper;
use Redlite\Modules\Comment\Models\Ratingcom;
use Redlite\Modules\Comment\InMemory\SQLCommentRepository;


class GetCommentByIdService{

    private $repository;

    public function __construct(SQLCommentRepository $repository){
        $this->repository = $repository;
    }

    public function execute($comment_id){
        try{
            $comment = $this->repository->getCommentById($comment_id);
            $newComment = Comment::createComment($comment["post_id"], $comment["user_id"], $comment["content"])->setId($comment["id"]);

            return $newComment;
        }catch (\Exception $exception){
            throw new \Exception();
        }
        return null;
        
    }
}


?>