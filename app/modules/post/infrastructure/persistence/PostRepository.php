<?php

namespace Redlite\Modules\Post\InMemory;

use Redlite\Modules\Post\Repository\IPostRepository;
use Redlite\Modules\Post\Models\Posts;
use Redlite\Modules\Post\Models\Post;
use Redlite\Modules\Post\Models\Ratings;

class PostRepository implements IPostRepository {
    
    public function create(Post $post){
        $posts = new Posts();
        $posts->id = $post->id()->id();
        $posts->title = $post->title();
        $posts->user_id = $post->user_id();
        $posts->description = $post->description();
        $posts->file = $post->file();
        $posts->save();
    }

    public function findPosts(){
        return Posts::find();
    }

    public function findRatings(){
        return Ratings::find();
    }

}


?>