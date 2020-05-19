<?php

namespace Redlite\Modules\Subredlite\Models;

class SubRedlite
{
    
    private $id;
    private $name;
    private $desc;
    private $ownerId;
    private $mods = [];

    /**
     * Construct a new Subredlite.
     * @param name: Name of the subredlite.
     * @param desc: Description of the subredlite.
     * @param ownerId: Owner Id of the subredlite.
     */
    public function __construct($name, $desc, $ownerId)
    {
        $this->$name = $name;
        $this->$desc = $desc;
        $this->$ownerId = $ownerId;
    }

    /**
     * Getter for id
     */
    public function id()
    {
        return $this->id;
    }

    /**
     * Getter for name
     */
    public function name()
    {
        return $this->name;
    }

    /**
     * Getter for desc
     */
    public function description()
    {
        return $this->desc;
    }

    /**
     * Getter for owner Id
     */
    public function ownerId()
    {
        return $this->ownerId;
    }

    /**
     * Add new moderators for this subredlite.
     */
    public function addMods($modId)
    {
        array_push($this->mods , $modId);
    } 


    /**
     * Create a new subredlite.
     */
    public static function createSubRedlite($name, $desc, $ownerId)
    {
        $subredlite = new SubRedlite($name , $desc, $ownerId);
        // Owner is mod by default.
        $subredlite->addMods($ownerId);

        return $subredlite;
    }
}

?>