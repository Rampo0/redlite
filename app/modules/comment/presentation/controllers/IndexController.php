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

        //ganti sama get post yang bener
        $post = Posts::findFirstById($post_id);

        $allComments = $this->getCommentService->execute(
            $post_id,
            $user_id,
        );

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

        //redirect kemana
        return $this->response->redirect('/comment/index/show/' . $post_id);
    }

    public function editAction($comment_id){
        $comment = Comments::findFirstById($comment_id);
        $this->view->comment = $comment;
    }

    public function saveAction($comment_id){
        $comment = Comments::findFirstById($comment_id);

        $comment->content = $this->request->getPost('content');
        $comment->save();
        return $this->response->redirect('/comment/index/show/' . $comment->post_id);
    }

    public function deleteAction($comment_id){
        $comment = Comments::findFirstById($comment_id);
        $comment->delete();
        
        return $this->response->redirect('/comment/index/show/' . $this->request->getPost('post_id'));
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

    public function ratingAction($comment_id){
        $user_id = $this->getDI()->getShared("session")->get('user_id');
        $comment_id = $this->request->getPost("comment_id");
        $rate = $this->request->getPost("rating");

        $rating = new Ratingcom();
        $rating->user_id = $user_id;
        $rating->comment_id = $comment_id;
        $rating->rating = $rate;
        $rating->save();

        $comment = Comments::findFirstById($comment_id);
        return $this->response->redirect('/comment/index/show/' . $comment->post_id);
    }

    public function unrateAction($comment_id){
        $user_id = $this->getDI()->getShared("session")->get('user_id');
        $rating = Ratingcom::find([
            'conditions' => 'user_id = :user: AND comment_id = :comment:',
            'bind' => [
                'user' => $user_id,
                'comment' => $comment_id,
            ],
        ]);
        $rating->delete();
        
        $comment = Comments::findFirstById($comment_id);
        return $this->response->redirect('/comment/index/show/' . $comment->post_id);
    }
}


?>