<?php

namespace Redlite\Modules\Post\Requests;

class AddRatingRequest
{
    private $user_id;
    private $rating;
    private $post_id;

    public function __construct($user_id , $rating , $post_id)
    {
        $this->post_id = $post_id;
        $this->user_id = $user_id;
        $this->rating = $rating;
    }

    public function post_id(){
        return $this->post_id;
    }

    public function user_id(){
        return $this->user_id;
    }

    public function rating(){
        return $this->rating;
    }

}

?>