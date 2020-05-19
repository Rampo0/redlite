<?php


namespace Redlite\Modules\Subredlite\Services;

use Redlite\Modules\Subredlite\Models\SubRedlite;
use Redlite\Modules\Subredlite\Models\ModsMapper;
use Redlite\Modules\Subredlite\InMemory\SubRedliteRepository;

class GetAllModsService
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
            $subs = $this->repository->getAllSubRedlite();
            $mods = $this->repository->getAllMods();

            $mapped = new ModsMapper($subs, $mods);
            $allSubs = $mapped->get();

            return $allSubs;
        }
        catch (\Exception $exception)
        {
            throw new \Exception();
        }

        return null;
    }
}


?>