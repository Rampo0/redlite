<?php

namespace Redlite\Modules\Comment\Controllers;

use Redlite\Modules\Comment\Models\Comment;
use Redlite\Modules\Comment\Models\Comments;
use Redlite\Modules\Comment\Models\Ratingcom;
use Redlite\Modules\Post\Models\Posts;

class IndexController extends ControllerBase{
    public function indexAction(){

    }

    public function show($post_id){
        // $user_id = $this->getDI()->getShared("session")->get('user_id');
        $user_id = 1;

        //ganti sama get post yang bener
        $post = Posts::findFirstById($post_id);

        $allComments = $this->getCommentService(
            $post_id,
            $user_id,
        );

        $this->view->post = $post;
        $this->view->comments = $allComments;
    }

    public function createAction($post_id){
        // $user_id = $this->getDI()->getShared("session")->get('user_id');
        $user_id = 1;

        try{
            $this->createCommentService->execute(
                $post_id,
                $user_id,
                $this->request->getPost('content')
            );
        }catch (\Exception $e){
            echo "something error !!";
        }

        //redirect kemana
    }

    public function editAction(){

    }

    public function deleteAction($comment_id){
        
    }
}


?>