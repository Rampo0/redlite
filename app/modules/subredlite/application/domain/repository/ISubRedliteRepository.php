<?php

namespace Redlite\Modules\Subredlite\Repository;

use Redlite\Modules\Subredlite\Models\SubRedlite;

interface ISubRedliteRepository {

    /**
     * Function to create a new subredlite.
     * @param model: new subredlite instance.
     */
    public function createSubRedlite(SubRedlite $model);

    /**
     * Function to get all registered subredlite.
     */
    public function getAllSubRedlite();

    /**
     * Function to get subredlite by it's id.
     * @param id: Integer id of the subredlite.
     */
    public function getSubRedlite($id);
}

?>