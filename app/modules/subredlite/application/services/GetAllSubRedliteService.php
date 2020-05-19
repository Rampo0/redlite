<?php


namespace Redlite\Modules\Subredlite\Services;

use Redlite\Modules\Subredlite\Models\SubRedlite;
use Redlite\Modules\Subredlite\InMemory\SubRedliteRepository;

class GetAllSubRedliteService
{

    private $repository;

    public function __construct(SubRedliteRepository $repository)
    {
        $this->repository = $repository;
    }

    public function execute()
    {
        try
        {
            $subredlites = $this->repository->getAllSubRedlite();
            return $subredlites;
        }
        catch (\Exception $exception)
        {
            throw new \Exception();
        }

        return null;
    }
}


?>