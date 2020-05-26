<?php

namespace Redlite\Modules\Comment\Controllers;

use Redlite\Modules\Comment\Models\Comment;
use Redlite\Modules\Comment\Models\Comments;
use Redlite\Modules\Comment\Models\Ratingcom;
use Redlite\Modules\Post\Models\Post;
use Redlite\Modules\Post\Models\Posts;
use Redlite\Modules\Subredlite\Models\Moderators;

class IndexController extends ControllerBase{
    public function indexAction(){

    }

    public function showAction($post_id){
        $user_id = $this->getDI()->getShared("session")->get('user_id');

        try{
            $post = $this->getPostByIdService->execute($post_id);
    
            $allComments = $this->getCommentService->execute(
                $post_id,
                $user_id
            );
        }catch (\Exception $e){
            echo "something error !!";
        }

        $this->view->post = $post;
        $this->view->comments = $allComments;
    }

    public function createAction($post_id){
        $user_id = $this->getDI()->getShared("session")->get('user_id');

        if($this->request->getPost('content')){
            try{
                $this->createCommentService->execute(
                    $post_id,
                    $user_id,
                    $this->request->getPost('content')
                );
            }catch (\Exception $e){
                echo "something error !!";
            }
        }

        return $this->response->redirect('/comment/index/show/' . $post_id);
    }

    public function editAction($comment_id){
        try{
            $comment = $this->getCommentByIdService->execute($comment_id);
        }catch (\Exception $e){
            echo "something error !!";
        }

        $this->view->comment = $comment;
    }

    public function saveAction($comment_id){
        try{
            $this->editCommentService->execute(
                $comment_id,
                $this->request->getPost('content')
            );

            $comment = $this->getCommentByIdService->execute($comment_id);
        }catch (\Exception $e){
            echo "something error !!";
        }

        return $this->response->redirect('/comment/index/show/' . $comment->postId());
    }

    public function deleteAction($comment_id){
        try{
            $this->deleteCommentService->execute($comment_id);
        }catch (\Exception $e){
            echo "something error !!";
        }
        
        return $this->response->redirect('/comment/index/show/' . $this->request->getPost('post_id'));
    }

    public function ratingAction($comment_id){
        $user_id = $this->getDI()->getShared("session")->get('user_id');
        $rate = $this->request->getPost("rating");

        try{
            $this->rateCommentService->execute(
                $comment_id,
                $user_id,
                $rate
            );

            $comment = $this->getCommentByIdService->execute($comment_id);
        }catch (\Exception $e){
            echo "something error !!";
        }

        return $this->response->redirect('/comment/index/show/' . $comment->postId());
    }

    public function unrateAction($comment_id){
        $user_id = $this->getDI()->getShared("session")->get('user_id');
        
        try{
            $this->unrateCommentService->execute(
                $comment_id,
                $user_id
            );

            $comment = $this->getCommentByIdService->execute($comment_id);
        }catch (\Exception $e){
            echo "something error !!";
        }

        return $this->response->redirect('/comment/index/show/' . $comment->postId());
    }



    /**
     * Function to force delete comments (only for mods).
     * TODO: Probably we can centralize our mods checking method.
     */
    public function forceDeleteAction($comment_id)
    {
        $user_id = $this->getDI()->getShared("session")->get('user_id');

        $post = Posts::findFirst([
            'conditions' => 'id = :post_id:',
            'bind'       => [
                'post_id' => $this->request->getPost('post_id'),
            ],
        ]);

        
        $mod = Moderators::findFirst([
            'subredlite_id = :subredlite_id: AND user_id = :user_id: AND active = 1',
            'bind'       => [
                'subredlite_id' => $post->subredlite_id,
                'user_id' => $user_id,
            ],
        ]);

        if ($mod)
        {
            $comment = Comments::findFirstById($comment_id);
            $comment->delete();
        }
        
        return $this->response->redirect('/comment/index/show/' . $this->request->getPost('post_id'));
    }
}


?>