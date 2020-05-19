<?php

namespace Redlite\Modules\Subredlite\InMemory;

use Redlite\Modules\Subredlite\Repository\ISubRedliteRepository;
use Redlite\Modules\Subredlite\Models\SubRedlite;
use Redlite\Modules\Subredlite\Models\SubRedliteModel;
use Redlite\Modules\Subredlite\Models\Moderators;

class SubRedliteRepository implements ISubRedliteRepository
{
    
    /**
     * Function to create a new subredlite.
     */
    public function createSubRedlite($name, $desc, $ownerId)
    {
        $subredlite = new SubRedliteModel();

        $subredlite->name = $name;
        $subredlite->description = $desc;
        $subredlite->owner_id = $ownerId;
        
        $subredlite->save();

        $this->addNewMod($subredlite->id, $ownerId);
    }

    /**
     * Function to create a new mods.
     */
    public function addNewMod($subsId, $userId)
    {
        $mod = new Moderators();
        $mod->user_id = $userId;
        $mod->subredlite_id = $subsId;
        $mod->active = 1;

        $mod->save();
    }

    /**
     * Function to get all registered subredlite.
     */
    public function getAllSubRedlite()
    {
        return SubRedliteModel::find();
    }

    /**
     * Function to get subredlite by it's id.
     * @param id: Integer id of the subredlite.
     */
    public function getSubRedlite($id)
    {
        return SubRedliteModel::findFirst($id);
    }

    /**
     * Function to get all moderators of subredlite.
     */
    public function getAllMods()
    {
        return Moderators::find();
    }

}


?>