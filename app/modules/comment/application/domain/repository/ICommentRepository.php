<?php

namespace Redlite\Modules\Comment\Repository;

use Redlite\Modules\Comment\Models\Comment;

interface ICommentRepository{
    public function create(Comment $comment);
    public function findComments($post_id);
    public function findRatings();
}