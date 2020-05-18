<?php

namespace Redlite\Modules\Post\Models;

class PostMapper{ 

    private $all_posts = [];

    public function __construct($posts, $ratings)
    {
        foreach ($posts as $post)
        {
            $postId = new PostId($post->id);
            $newPost = new Post($postId, $post->user_id , $post->title, $post->description, $post->file);
            $newPost->setCreatedAt($post->created_at);
            $this->all_posts[$post->id] = $newPost;
        }

        foreach ($ratings as $rating)
        {
            $post = $this->all_posts[$rating->post_id];
            $post->appendRating($rating);
            $this->all_posts[$rating->post_id] = $post;
        }
    }

    public function get(){
        return $this->all_posts;
    }

}


?>