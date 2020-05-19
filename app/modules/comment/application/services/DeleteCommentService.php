<?php


namespace Redlite\Modules\Comment\Services;

use Redlite\Modules\Comment\Models\Comment;
use Redlite\Modules\Comment\Models\Ratingcom;
use Redlite\Modules\Comment\InMemory\CommentRepository;

use Phalcon\Mvc\Model\Query;
use Phalcon\Mvc\Model\Query\Builder;
use Phalcon\Mvc\Model\Manager;

class DeleteCommentService{

    private $repository;

    public function __construct(CommentRepository $repository){
        $this->repository = $repository;
    }

    public function execute($comment_id){
        try{
            $ratings = $this
                ->modelsManager
                ->executeQuery(
                    'SELECT * FROM Redlite\Modules\Comment\Models\Ratingcom WHERE comment_id = :id:',
                    [
                        'id' => $comment_id,
                    ]
                );
            $this->repository->delete($comment_id, $ratings);
        }catch (\Exception $exception){
            throw new \Exception();
        }
        
    }
}


?>