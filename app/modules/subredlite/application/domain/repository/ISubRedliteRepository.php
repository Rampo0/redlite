<?php

namespace Redlite\Modules\Subredlite\Repository;

use Redlite\Modules\Subredlite\Models\SubRedlite;
use Redlite\Modules\Subredlite\Models\Announcement;

interface ISubRedliteRepository
{

    /**
     * Function to create a new subredlite.
     * @param model: new subredlite instance.
     */
    public function createSubRedlite($name, $desc, $ownerId);

    /**
     * Function to create a new announcement.
     */
    public function createAnnouncement(Announcement $post, $subredliteId);

    /**
     * Function to create a new mods.
     */
    public function addNewMod($subsId, $userId);

    /**
     * Function to get all registered subredlite.
     */
    public function getAllSubRedlite();

    /**
     * Function to get subredlite by it's id.
     * @param id: Integer id of the subredlite.
     */
    public function getSubRedlite($id);

    /**
     * Function to get all moderators of subredlite.
     */
    public function getAllMods();
}

?>