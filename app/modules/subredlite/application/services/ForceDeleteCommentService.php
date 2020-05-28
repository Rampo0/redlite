<?php


namespace Redlite\Modules\Subredlite\Services;

use Redlite\Modules\Subredlite\Models\Moderators;
use Redlite\Modules\Subredlite\InMemory\SubRedliteRepository;

class ForceDeleteCommentService
{
    private $repository;

    public function __construct(SubRedliteRepository $repository)
    {
        $this->repository = $repository;
    }

    public function execute($subredlite_id, $user_id, $comment_id)
    {
        try
        {
            $status = $this->repository->getModStatus($user_id, $subredlite_id);

            if ($status)
            {
                $this->repository->forceRemoveCommentSection($comment_id);
            }
        }
        catch (\Exception $exception)
        {
            throw new \Exception();
        }
    }
}


?>