<?php

namespace Redlite\Modules\Post\Models;

class Rating{

    private $user_id;
    private $rating;
    private $post_id;

    public function __construct($user_id, $rating, $post_id)
    {
        $this->rating = $rating;
        $this->post_id = $post_id;
        $this->user_id = $user_id;
    }

    public function user_id(){
        return $this->user_id;
    }

    public function post_id(){
        return $this->post_id;
    }
    
    public function rating(){
        return $this->rating;
    }

    public function equals(Rating $rating) 
    {
        return $this->user_id === $rating->user_id() && 
                $this->post_id === $rating->post_id();
    }

}


?>