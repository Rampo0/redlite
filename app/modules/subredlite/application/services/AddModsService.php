<?php


namespace Redlite\Modules\Subredlite\Services;

use Redlite\Modules\Subredlite\Models\Moderators;
use Redlite\Modules\Subredlite\InMemory\SubRedliteRepository;

class AddModsService
{

    private $repository;

    public function __construct(SubRedliteRepository $repository)
    {
        $this->repository = $repository;
    }

    public function execute($userId, $subsId)
    {
        try
        {
            $this->repository->addNewMod($subsId, $userId);
        }
        catch (\Exception $exception)
        {
            throw new \Exception();
        }
    }

}


?>