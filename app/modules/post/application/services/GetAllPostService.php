<?php


namespace Redlite\Modules\Post\Services;

use Redlite\Modules\Post\Models\Post;
use Redlite\Modules\Post\Models\PostMapper;
use Redlite\Modules\Post\InMemory\PostRepository;


class GetAllPostService{

    private $repository;

    public function __construct(PostRepository $repository){
        $this->repository = $repository;
    }

    public function execute($user_id){
        try{
            $posts = $this->repository->findPosts();
            $ratings = $this->repository->findRatings();
            $post_mapper = new PostMapper($posts, $ratings , $user_id);
            $all_posts = $post_mapper->get();
            return $all_posts;
        }catch (\Exception $exception){
            throw new \Exception();
        }
        return null;
    }

}


?>