<?php

namespace Redlite\Modules\Post\Requests;

class UnrateRequest
{
    private $user_id;
    private $post_id;

    public function __construct($user_id , $post_id)
    {
        $this->post_id = $post_id;
        $this->user_id = $user_id;
    }

    public function post_id(){
        return $this->post_id;
    }

    public function user_id(){
        return $this->user_id;
    }

}

?>