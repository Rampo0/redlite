<?php

namespace Redlite\Modules\Post\Models;
use Phalcon\Mvc\Model;

class Posts extends Model{
    public $id;
    public $title;
    public $description;
    public $file;
    public $user_id;
    public $created_at;
    public $able_to_comment;
    public $subredlite_id;
    public $is_announcement;
}

?>