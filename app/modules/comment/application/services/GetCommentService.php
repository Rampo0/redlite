<?php


namespace Redlite\Modules\Comment\Services;

use Redlite\Modules\Comment\Models\Comment;
use Redlite\Modules\Comment\Models\CommentMapper;
use Redlite\Modules\Comment\Models\Ratingcom;
use Redlite\Modules\Comment\InMemory\CommentRepository;


class GetCommentService{

    private $repository;

    public function __construct(CommentRepository $repository){
        $this->repository = $repository;
    }

    public function execute($post_id, $user_id){
        try{
            $comments = $this->repository->findComments($post_id);
            // $ratings = [];
            // foreach($comments as $comment){
            //     $newRate = $this->repository->findRatings($comment->id);
            //     $ratings = array_merge($ratings, $newRate);
            // }
            
            $ratings = $this->repository->findRatings(0);

            $commentMap = new CommentMapper($comments, $ratings, $user_id);
            $allComments = $commentMap->getAllComment();

            return $allComments;
        }catch (\Exception $exception){
            throw new \Exception();
        }
        return null;
        
    }
}


?>