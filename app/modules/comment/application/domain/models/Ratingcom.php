<?php

namespace Redlite\Modules\Comment\Models;
use Phalcon\Mvc\Model;

class Ratingcom extends Model{
    public $id;
    public $user_id;
    public $comment_id;
    public $rating;
}

?>