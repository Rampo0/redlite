<?php

namespace Redlite\Modules\Post\Repository;

use Redlite\Modules\Post\Models\Post;
use Redlite\Modules\Post\Models\PostId;
use Redlite\Modules\Post\Models\Rating;

interface IPostRepository{
    public function create(Post $post);
    public function findPosts();
    public function findRatings();
    public function delete(PostId $post_id);
    public function findPostById(PostId $post_id);
    public function update(array $post);
    public function getRatingByPostId(PostId $post_id);
    public function addRating(Rating $rating);
    public function unrate(Rating $rating);
}

?>