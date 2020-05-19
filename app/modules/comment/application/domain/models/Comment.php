<?php

namespace Redlite\Modules\Comment\Models;

class Comment{

    private $id;
    private $post_id;
    private $user_id;
    private $content;
    private $totalRating = 0;
    private $rating = [];
    private $isRated = false;

    public function __construct($post_id, $user_id, $content)
    {
        $this->post_id = $post_id;
        $this->user_id = $user_id;
        $this->content = $content;
    }

    public static function createComment($post_id, $user_id, $content){
        $instance = new self($post_id, $user_id, $content);
        return $instance;
    }
    
    // overloading klo id nya udah ada (cuma buat mapping bukan bikin baru)
    public function setId($comment_id){
        $this->id = $comment_id;
        return $this;
    }

    public function addRate($rate){
        array_push($this->rating, $rate);
    }

    public function averageRating(){
        $total = 0;
        foreach ($this->rating as $rate) {
            $total+=$rate;
        }
        
        if(count($this->rating) > 0){
            return $total/count($this->rating);
        }
        
        return 0;
    }

    public function isRated(){
        return $this->isRated;
    }

    public function setRate(){
        $this->isRated = true;
    }

    public function id(){
        return $this->id;
    }

    public function postId(){
        return $this->post_id;
    }

    public function userId(){
        return $this->user_id;
    }

    public function content(){
        return $this->content;
    }

    public function totalRating(){
        return $this->totalRating;
    }
}


?>