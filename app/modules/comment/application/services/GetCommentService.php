<?php


namespace Redlite\Modules\Comment\Services;

use Redlite\Modules\Comment\Models\Comment;
use Redlite\Modules\Comment\Models\CommentMapper;
use Redlite\Modules\Comment\Models\Ratingcom;
use Redlite\Modules\Comment\InMemory\SQLCommentRepository;


class GetCommentService{

    private $repository;

    public function __construct(SQLCommentRepository $repository){
        $this->repository = $repository;
    }

    public function execute($post_id, $user_id){
        try{
            $comments = $this->repository->findComments($post_id);

            $commentMapper = new CommentMapper($comments);
            
            foreach($comments as $comment){
                $ratings = $this->repository->findRatings($comment["id"]);
                $commentMapper->mapRating($ratings, $user_id);
            }

            $allComments = $commentMapper->getAllComment();

            return $allComments;
        }catch (\Exception $exception){
            throw new \Exception();
        }
        return null;
        
    }
}


?>