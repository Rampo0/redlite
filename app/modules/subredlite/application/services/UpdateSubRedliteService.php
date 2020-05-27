<?php


namespace Redlite\Modules\Subredlite\Services;

use Redlite\Modules\Subredlite\Models\SubRedlite;
use Redlite\Modules\Subredlite\InMemory\SubRedliteRepository;

require_once __DIR__ . "/../../../../../vendor/autoload.php";

use Ramsey\Uuid\Uuid;

class UpdateSubRedliteService
{

    private $repository;

    public function __construct(SubRedliteRepository $repository)
    {
        $this->repository = $repository;
    }

    public function execute($id, $name, $desc)
    {
        try
        {
            $subredlite = $this->repository->findSubRedliteById($id);
            $subredlite['id'] = $id;
            $subredlite['name'] = $name;
            $subredlite['description'] = $desc;

            $this->repository->updateSubRedlite($subredlite);
        }
        catch (\Exception $exception)
        {
            throw new \Exception();
        }
    }

}


?>