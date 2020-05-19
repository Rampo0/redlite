<?php


namespace Redlite\Modules\Subredlite\Services;

use Redlite\Modules\Subredlite\Models\SubRedlite;
use Redlite\Modules\Subredlite\InMemory\SubRedliteRepository;

class GetSubRedliteService
{

    private $repository;

    public function __construct(SubRedliteRepository $repository)
    {
        $this->repository = $repository;
    }

    public function execute($id)
    {
        try
        {
            $subredlite = $this->repository->getSubRedlite($id);
            return $subredlite;
        }
        catch (\Exception $exception)
        {
            throw new \Exception();
        }

        return null;
    }
}


?>