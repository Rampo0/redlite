<?php


namespace Redlite\Modules\Subredlite\Services;

use Redlite\Modules\Post\Models\Post;
use Redlite\Modules\Subredlite\Models\Announcement;
use Redlite\Modules\Subredlite\InMemory\SubRedliteRepository;

class CreateAnnouncementService
{
    private $repository;

    public function __construct(SubRedliteRepository $repository)
    {
        $this->repository = $repository;
    }

    public function execute($user_id, $title, $description, $file, $subredliteId)
    {
        try
        {
            $newPost = Announcement::createAnnouncement($user_id, $title, $description, $file);
            $this->repository->createAnnouncement($newPost, $subredliteId);
        }
        catch (\Exception $exception)
        {
            throw new \Exception();
        }
    }

}


?>