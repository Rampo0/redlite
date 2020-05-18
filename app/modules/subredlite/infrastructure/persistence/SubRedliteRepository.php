<?php

namespace Redlite\Modules\Subredlite\InMemory;

use Redlite\Modules\Subredlite\Repository\ISubRedliteRepository;
use Redlite\Modules\Subredlite\Models\SubRedlite;
use Redlite\Modules\Subredlite\Models\SubRedliteModel;

class SubRedliteRepository implements ISubRedliteRepository {
    
     /**
     * Function to create a new subredlite.
     * @param model: new subredlite instance.
     */
    public function createSubRedlite(SubRedlite $model) {
        $subredlite = new SubRedliteModel();

        $subredlite->id = $model->id()->id;
        $subredlite->name = $model->name();
        $subredlite->description = $model->description();
        $subredlite->owner_id = $model->ownerId();

        $subredlite->save();
    }

    /**
     * Function to get all registered subredlite.
     */
    public function getAllSubRedlite() {
        return SubRedliteModel::find();
    }

    /**
     * Function to get subredlite by it's id.
     * @param id: Integer id of the subredlite.
     */
    public function getSubRedlite($id) {
        return SubRedliteModel::findFirst($id);
    }

}


?>