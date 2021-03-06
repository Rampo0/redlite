<?php

namespace Redlite\Modules\Comment\Models;

class CommentMapper{
    private $all_comments = [];

    public function __construct($comments){
        foreach ($comments as $comment){
            $this->all_comments[$comment["id"]] = Comment::createComment($comment["post_id"], $comment["user_id"], $comment["content"])->setId($comment["id"]);
        }
    }

    public function mapRating($ratings, $user_id){
        foreach ($ratings as $rating){
            $comment = $this->all_comments[$rating["comment_id"]];
            if($comment){
                $comment->addRate($rating["rating"]);

                if($rating["user_id"] == $user_id){
                    $comment->setRate();
                }

                $this->all_comments[$rating["comment_id"]] = $comment;
            }
        }
    }

    public function getAllComment(){
        return $this->all_comments;
    }
}

?>