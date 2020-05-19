<?php

namespace Redlite\Modules\Comment\Models;
use Phalcon\Mvc\Model;

class Comments extends Model{
    public $id;
    public $user_id;
    public $post_id;
    public $content;
}

?>