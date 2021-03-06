<?php


namespace Redlite\Modules\Subredlite\Services;

use Redlite\Modules\Subredlite\Models\SubRedlite;
use Redlite\Modules\Subredlite\InMemory\SubRedliteRepository;

require_once __DIR__ . "/../../../../../vendor/autoload.php";

use Ramsey\Uuid\Uuid;

class CreateSubRedliteService
{

    private $repository;

    public function __construct(SubRedliteRepository $repository)
    {
        $this->repository = $repository;
    }

    public function execute($name, $desc, $ownerId)
    {
        try
        {
            $newSubredlite = Subredlite::createSubRedlite(Uuid::uuid4()->toString(), $name , $desc, $ownerId);
            $this->repository->createSubRedlite($newSubredlite);
        }
        catch (\Exception $exception)
        {
            throw new \Exception();
        }
    }

}


?>