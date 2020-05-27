<?php

namespace Redlite\Modules\Subredlite\Models;

class Moderators
{

    private $id;
    private $subredliteId;
    private $userId;
    private $active;

    public function __construct($id, $subredliteId, $userId, $active)
    {
        $this->id = $id;
        $this->subredliteId = $subredliteId;
        $this->userId = $userId;
        $this->active = $active;
    }

    /**
     * Getter for id
     */
    public function id()
    {
        return $this->id;
    }

    /**
     * Getter for subredliteId
     */
    public function subredliteId()
    {
        return $this->subredliteId;
    }

    /**
     * Getter for userId
     */
    public function userId()
    {
        return $this->userId;
    }

    /**
     * Getter for active
     */
    public function active()
    {
        return $this->active;
    }


    /**
     * Create a new subredlite.
     */
    public static function createModerator($id, $subredlite_id, $user_id, $active)
    {
        $subredlite = new Moderators($id, $subredlite_id , $userId, $active);

        return $subredlite;
    }
}

?>