<?php


namespace Redlite\Modules\Comment\Services;

use Redlite\Modules\Comment\Models\Comment;
use Redlite\Modules\Comment\InMemory\CommentRepository;

class CreateCommentService{

    private $repository;

    public function __construct(CommentRepository $repository){
        $this->repository = $repository;
    }

    public function execute($post_id, $user_id, $content){
        try{
            $newComment = Comment::createComment($post_id, $user_id, $content);
            $this->repository->create($newComment);
        }catch (\Exception $exception){
            throw new \Exception();
        }
        
    }
}


?>