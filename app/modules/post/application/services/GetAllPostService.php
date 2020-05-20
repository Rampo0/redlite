<?php


namespace Redlite\Modules\Post\Services;

use Redlite\Modules\Post\Models\Post;
use Redlite\Modules\Post\Models\PostMapperDTO;
use Redlite\Modules\Post\InMemory\PostRepository;
use Redlite\Modules\Post\InMemory\SqlPostRepository;

class GetAllPostService{

    private $repository;

    public function __construct(SqlPostRepository $repository){
        $this->repository = $repository;
    }

    public function execute($user_id){
        try{
            $posts = $this->repository->findPosts();
            $ratings = $this->repository->findRatings();
            $post_mapper = new PostMapperDTO($posts, $ratings , $user_id);
            $all_posts = $post_mapper->get();
            return $all_posts;
        }catch (\Exception $exception){
            throw new \Exception();
        }
        return null;
    }

}


?>