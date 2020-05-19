<?php

namespace Redlite\Modules\Subredlite\Models;
use Phalcon\Mvc\Model;

class Moderators extends Model
{

    /**
     * Id of the field.
     */
    public $id;

    /**
     * Id of the subredlite.
     */
    public $subredlite_id;

    /**
     * Id of the user.
     */
    public $user_id;

    /**
     * Whether this user is still an active mod.
     */
    public $active;
}

?>