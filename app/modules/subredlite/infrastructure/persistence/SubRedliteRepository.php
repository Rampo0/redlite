<?php

namespace Redlite\Modules\Subredlite\InMemory;

use Redlite\Modules\Subredlite\Repository\ISubRedliteRepository;
use Redlite\Modules\Subredlite\Models\SubRedlite;
use Redlite\Modules\Subredlite\Models\Moderators;
use Redlite\Modules\Subredlite\Models\Announcement;
use Redlite\Modules\Post\Models\Posts;
use Phalcon\Db\Adapter\Pdo\Mysql;
use PDO;

class SubRedliteRepository implements ISubRedliteRepository
{

    private $database;

    public function __construct(Mysql $database)
    {
       $this->database = $database;
    }
    
    /**
     * Function to create a new subredlite.
     */
    public function createSubRedlite(SubRedlite $subredlite)
    {
        $statement = sprintf("INSERT INTO subredlite(id, name, description, owner_id) VALUES(:id, :name, :description, :owner_id)" );
        $params = [
            'id' => $subredlite->id(),
            'name' => $subredlite->name(),
            'description' => $subredlite->description(),
            'owner_id' => $subredlite->ownerId()
        ];

        $this->addNewMod($subredlite->id(), $subredlite->ownerId());

        return $this->database->execute($statement, $params);
    }

    /**
     * Function to get Subredlite by its ID.
     */
    public function findSubRedliteById($id)
    {
        $statement = sprintf("SELECT * FROM subredlite WHERE subredlite.id = :id");
        $param = [
            'id' => $id
        ];

        return $this->database
            ->query($statement, $param)
            ->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * Function to to update subredlite.
     */
    public function updateSubRedlite(array $subredlite)
    {
        $statement = sprintf("UPDATE subredlite SET subredlite.name = :name, subredlite.description = :desc WHERE subredlite.id = :id");
        $params = [
            'id' => $subredlite['id'],
            'name' => $subredlite['name'],
            'desc' => $subredlite['description']
        ];

        return $this->database->execute($statement, $params);
    }

    /**
     * Function to create a new announcement.
     */
    public function createAnnouncement(Announcement $post, $subredliteId)
    {
        $statement = sprintf("INSERT INTO posts(id, title, description, file, user_id, is_announcement) VALUES(:id, :title, :description, :file, :user_id, 1)" );
        $params = ['id' => $post->id()->id() , 'title' => $post->title(), 'description' => $post->description(), 'file' => $post->file(), 'user_id' => $post->user_id()];

        return $this->database->execute($statement, $params);
    }

    /**
     * Function to create a new mods.
     */
    public function addNewMod($subsId, $userId)
    {
        $statement = sprintf("INSERT INTO moderators(subredlite_id, user_id, active) VALUES(:subredlite_id, :user_id, :active)" );
        $params = [
            'subredlite_id' => $subsId,
            'user_id' => $userId,
            'active' => 1
        ];

        return $this->database->execute($statement, $params);
    }

    /**
     * Function to get all registered subredlite.
     */
    public function getAllSubRedlite()
    {
        $statement = sprintf("SELECT * FROM subredlite");

        return $this->database
            ->query($statement)
            ->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Function to get all moderators of subredlite.
     */
    public function getAllMods()
    {
        $statement = sprintf("SELECT * FROM moderators");

        return $this->database
            ->query($statement)
            ->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Function to get moderator by its ID.
     */
    public function findModById($id, $all = true)
    {
        if (all) 
        {
            $statement = sprintf("SELECT * FROM moderators WHERE moderators.id = :id");
        }
        else
        {
            $statement = sprintf("SELECT * FROM moderators WHERE moderators.id = :id AND moderators.active = 1");
        }

        $param = [
            'id' => $id
        ];

        return $this->database
            ->query($statement, $param)
            ->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * Function to to update mods.
     */
    public function updateMod(array $mods)
    {
        $statement = sprintf("UPDATE moderators SET moderators.active = :active WHERE moderators.id = :id");
        $params = [
            'id' => $mods['id'],
            'active' => $mods['active']
        ];

        return $this->database->execute($statement, $params);
    }
}


?>