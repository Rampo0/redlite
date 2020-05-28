<?php


namespace Redlite\Modules\Subredlite\Services;

use Redlite\Modules\Subredlite\Models\Moderators;
use Redlite\Modules\Subredlite\InMemory\SubRedliteRepository;

class RemoveModAccessService
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
            $mod = $this->repository->findModById($id);
            $mod['id'] = $id;
            $mod['active'] = 0;

            $this->repository->updateMod($mod);
        }
        catch (\Exception $exception)
        {
            throw new \Exception();
        }
    }

}


?>