<?php

namespace Redlite\Modules\Comment\InMemory;

use Redlite\Modules\Comment\Repository\ICommentRepository;
use Redlite\Modules\Comment\Models\Comment;
use Redlite\Modules\Comment\Models\Comments;
use Redlite\Modules\Comment\Models\Ratingcom;

use Phalcon\Mvc\Model\Query;
use Phalcon\Mvc\Model\Query\Builder;
use Phalcon\Mvc\Model\Manager;

class CommentRepository extends ICommentRepository{
    public function create(Comment $comment){
        $newComment = new Comments();
        $newComment->user_id = $comment->userId();
        $newComment->post_id = $comment->postId();
        $newComment->content = $comment->content();

        $newComment->save();

    }

    public function delete($comment_id, $ratings){
        $comment = Comments::findFirstById($comment_id);
        $comment->delete();

        foreach($ratings as $rating){
            $rating->delete();
        }
    }

    public function findComments($post_id){
        $listAllComment = $this
            ->modelsManager
            ->executeQuery(
                'SELECT * FROM Redlite\Modules\Comment\Models\Comments WHERE post_id = :id:',
                [
                    'id' => $post_id,
                ]
            );

        return $listAllComment;
    }

    public function findRatings($comment_id){
        $listAllRating = $this
            ->modelsManager
            ->executeQuery(
                'SELECT * FROM Redlite\Modules\Comment\Models\Ratingcom WHERE comment_id = :id:',
                [
                    'id' => $comment_id,
                ]
            );
        
        return $listAllRating;
    }
}


?>