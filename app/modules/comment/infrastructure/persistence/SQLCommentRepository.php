<?php

namespace Redlite\Modules\Comment\InMemory;

use Redlite\Modules\Comment\Repository\ICommentRepository;
use Redlite\Modules\Comment\Models\Comment;
use Redlite\Modules\Comment\Models\Comments;
use Redlite\Modules\Comment\Models\Ratingcom;

use Phalcon\Mvc\Model\Query;
use Phalcon\Mvc\Model\Query\Builder;
use Phalcon\Mvc\Model\Manager;
use Phalcon\Db\Adapter\Pdo\Mysql;
use PDO;

class SQLCommentRepository{

    private $db;

    public function __construct(Mysql $db)
    {
       $this->db = $db;
    }

    public function create(Comment $comment){
        $statement = sprintf("INSERT INTO comments(user_id, post_id, content) VALUES(:userid, :postid, :content)");
        $params = [
            'userid' => $comment->userId(), 
            'postid' => $comment->postId(),
            'content' => $comment->content()
        ];

        return $this->db->execute($statement, $params);
    }

    public function delete($comment_id){
        $statement = sprintf("DELETE FROM comments WHERE comments.id = :commentid");
        $params = ['commentid' => $comment_id];
        $this->db->execute($statement, $params);

        $statement = sprintf("DELETE FROM ratingcom WHERE ratingcom.comment_id = :commentid");
        $this->db->execute($statement, $params);

        return;
    }

    public function update($comment_id, $content){
        $statement = sprintf("UPDATE comments SET comments.content = :content WHERE comments.id = :commentid");
        $params = [
            "content" => $content,
            "commentid" => $comment_id
        ];

        return $this->db->execute($statement, $params);
    }

    public function rate($comment_id, $user_id, $rating){
        $statement = sprintf("INSERT INTO ratingcom(user_id, comment_id, rating) VALUES(:userid, :commentid, :rate)");
        $params = [
            "userid" => $user_id,
            "commentid" => $comment_id,
            "rate" => $rating
        ];
        
        return $this->db->execute($statement, $params);
    }

    public function unrate($comment_id, $user_id){
        $statement = sprintf("DELETE FROM ratingcom WHERE ratingcom.comment_id = :commentid AND ratingcom.user_id = :userid");
        $params = [
            "userid" => $user_id,
            "commentid" => $comment_id
        ];

        $this->db->execute($statement, $params);
    }

    public function getCommentById($comment_id){
        $statement = sprintf("SELECT * FROM comments WHERE comments.id = :commentid");
        $params = ['commentid' => $comment_id];

        return $this->db->query($statement, $params)
            ->fetch(PDO::FETCH_ASSOC);
    }

    public function findComments($post_id){
        $statement = sprintf("SELECT * FROM comments WHERE comments.post_id = :postid");
        $params = ['postid' => $post_id];

        return $this->db->query($statement, $params)
            ->fetchAll(PDO::FETCH_ASSOC);
    }

    public function findRatings($comment_id){
        $statement = sprintf("SELECT * FROM ratingcom WHERE ratingcom.comment_id = :commentid");
        $params = ['commentid' => $comment_id];
        
        return $this->db->query($statement, $params)
            ->fetchAll(PDO::FETCH_ASSOC);
    }
}


?>