<?php

namespace Redlite\Modules\Post\InMemory;

use Redlite\Modules\Post\Repository\IPostRepository;
use Redlite\Modules\Post\Models\Posts;
use Redlite\Modules\Post\Models\Post;
use Redlite\Modules\Post\Models\Ratings;
use Redlite\Modules\Post\Models\Rating;
use Redlite\Modules\Post\Models\PostId;
use Phalcon\Db\Adapter\Pdo\Mysql;
use PDO;

class SqlPostRepository implements IPostRepository{


    private $db;

    public function __construct(Mysql $db)
    {
       $this->db = $db;
    }

    public function create(Post $post){
        $statement = sprintf("INSERT INTO posts(id, title, description, file, user_id) VALUES(:id, :title, :description, :file, :user_id)" );
        $params = ['id' => $post->id()->id() , 'title' => $post->title(), 'description' => $post->description(), 'file' => $post->file(), 'user_id' => $post->user_id()];

        return $this->db->execute($statement, $params);
    }

    public function update(array $post){
        $statement = sprintf("UPDATE posts SET posts.title = :title , posts.description = :desc , posts.file = :file WHERE posts.id = :post_id");
        $params = ['post_id' => $post['id'] , 'title' => $post['title'], 'desc' => $post['description'], 'file' => $post['file']];

        return $this->db->execute($statement, $params);
    }

    public function delete(PostId $post_id){
        $statement = sprintf("DELETE FROM posts WHERE posts.id = :post_id");
        $params = ['post_id' => $post_id->id()];

        return $this->db->execute($statement, $params);
    }

    public function findPostById(PostId $post_id){
        $statement = sprintf("SELECT * FROM posts WHERE posts.id = :post_id");
        $param = ['post_id' => $post_id->id()];

        return $this->db->query($statement, $param)
            ->fetch(PDO::FETCH_ASSOC);
    }

    public function addRating(Rating $rating){
        $statement = sprintf("INSERT INTO ratings(user_id, rating, post_id) VALUES(:user_id , :rating, :post_id)");
        $params = ['user_id' => $rating->user_id(), 'rating' => $rating->rating(), 'post_id' => $rating->post_id()];

        return $this->db->execute($statement, $params);
    }

    public function getRatingByPostId(PostId $post_id){
        $statement = sprintf("SELECT * FROM ratings WHERE ratings.post_id = :post_id");
        $param = ['post_id' => $post_id->id()];

        return $this->db->query($statement, $param)
            ->fetchAll(PDO::FETCH_ASSOC);
    }

    public function unrate(Rating $rating){
        $statement = sprintf("DELETE FROM ratings WHERE ratings.user_id = :user_id AND ratings.post_id = :post_id ");
        $params = ['user_id' => $rating->user_id(), 'post_id' => $rating->post_id()];

        return $this->db->execute($statement, $params);
    }

    public function findPosts(){
        $statement = sprintf("SELECT * FROM posts");

        return $this->db->query($statement)
            ->fetchAll(PDO::FETCH_ASSOC);
    }

    public function findRatings(){
        $statement = sprintf("SELECT * FROM ratings");

        return $this->db->query($statement)
            ->fetchAll(PDO::FETCH_ASSOC);
    }

}


?>