<?php

namespace Redlite\Modules\Post\Models;
use Exception;

class Post{

    private $id;
    private $title;
    private $description;
    private $file;
    private $user_id;
    private $totalRating = 0;
    private $rating = [];
    private $created_at;
    private $isRatedByYou = false;
    private $able_to_comment = 1;
    private $is_announcement = 0;
    private $subredlite_id;

    public function __construct(PostId $id, $user_id, $title, $description , $file)
    {
        $this->title = $title;
        $this->description = $description;
        $this->file = $file;
        $this->user_id = $user_id;
        $this->id = $id;
    }

    public function id(){
        return $this->id;
    }

    public function totalRating(){
        return $totalRating;
    }

    public static function addRating($allRatings ,$user_id , $rating , $post_id){
        $newRating = new Rating($user_id, $rating , $post_id);

        if($allRatings){
            $is_exist = false;
            foreach ($allRatings as $rating) {
                $currentRating = new Rating( $rating['user_id'] , $rating['rating'] , $rating['post_id']);
                if($newRating->equals($currentRating)){
                    $is_exist = true;
                    break;
                }
            }

            if($is_exist == false){
                return $newRating;
            }

        }else{
            return $newRating;
        }

        return null;
    }

    public function averageRating(){
        $total = 0;
        foreach ($this->rating as $rate) {
            $total+=$rate['rating'];
        }
        
        if(count($this->rating) > 0){
            return $total/count($this->rating);
        }
        
        return 0;
    }

    public function description(){
        return $this->description;
    }

    public function title(){
        return $this->title;
    }

    public function user_id(){
        return $this->user_id;
    }

    public function created_at(){
        return $this->created_at;
    }

    public function file(){
        return $this->file;
    }

    public function appendRating($rate){
        array_push($this->rating , $rate);
    } 

    public function setCreatedAt($created_at){
        $this->created_at = $created_at;
    }

    public function setIsRated($isRated){
        $this->isRatedByYou = $isRated;
    }

    public function is_rated(){
        return $this->isRatedByYou;
    }

    public function isAbleToComment()
    {
        return $this->able_to_comment;
    }

    public function setCommentLocked($status)
    {
        $this->able_to_comment = $status;
    }

    public function subRedliteId()
    {
        return $this->subredlite_id;
    }

    public function setSubRedliteId($subredlite_id)
    {
        $this->subredlite_id = $subredlite_id;
    }

    public static function createPost($user_id , $title , $description , $file){
        return new Post(new PostId(), $user_id, $title , $description , $file);
    }

}


?>