<?php

namespace Redlite\Modules\Subredlite\Models;

class SubsMod
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

    public function __construct($id, $subsId, $userId, $active)
    {
        $this->id = $id;
        $this->subredlite_id = $subsId;
        $this->user_id = $userId;
        $this->active = $active;
    }
}

?>