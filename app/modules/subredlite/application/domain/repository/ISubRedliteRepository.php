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
    public function createSubRedlite(SubRedlite $subredlite);

    /**
     * Function to get Subredlite by it's ID.
     */
    public function findSubRedliteById($id);

    /**
     * Function to to update subredlite.
     */
    public function updateSubRedlite(array $subredlite);

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
     * Function to get all moderators of subredlite.
     */
    public function getAllMods();

    /**
     * Function to get moderator by its ID.
     */
    public function findModById($id);

    /**
     * Function to to update mods.
     */
    public function updateMod(array $mods);
}

?>