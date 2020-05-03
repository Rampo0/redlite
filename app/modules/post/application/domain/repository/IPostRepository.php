<?php

namespace Redlite\Modules\Post\Repository;

use Redlite\Modules\Post\Models\Post;

interface IPostRepository{
    public function create(Post $post);
    public function findPosts();
    public function findRatings();
}

?>