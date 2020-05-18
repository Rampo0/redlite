<?php


namespace Redlite\Modules\Subredlite\Services;

use Redlite\Modules\Subredlite\Models\SubRedlite;
use Redlite\Modules\Subredlite\InMemory\SubRedliteRepository;

class CreateSubRedliteService {

    private $repository;

    public function __construct(SubRedliteRepository $repository) {
        $this->repository = $repository;
    }

    public function execute($name, $desc, $ownerId) {
        try {
            $newSubredlite = SubRedlite::createSubRedlite($name, $desc, $ownerId);
            $this->repository->createSubRedlite($newSubredlite);
        } catch (\Exception $exception){
            throw new \Exception();
        }
    }

}


?>