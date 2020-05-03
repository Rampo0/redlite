<?php

namespace Redlite\Modules\Post\Models;
use Phalcon\Mvc\Model;

class Ratings extends Model{
    public $id;
    public $user_id;
    public $rating;
    public $post_id;
}

?>