<?php
declare(strict_types=1);

namespace Redlite\Modules\Post\Controllers;

use Redlite\Modules\Post\Models\Posts;
use Redlite\Modules\Post\Models\Ratings;
use Redlite\Modules\Post\Requests\CreatePostRequest;
use Redlite\Modules\Post\Requests\UpdatePostRequest;
use Redlite\Modules\Post\Requests\AddRatingRequest;
use Redlite\Modules\Post\Requests\UnrateRequest;

class IndexController extends ControllerBase
{

    public function indexAction(){  

        $user_id = $this->getDI()->getShared("session")->get('user_id');
        if (!$user_id) {
            return $this->response->redirect("/user");
        }

        $posts = $this->getAllPostService->execute($user_id);
        $this->view->posts = $posts;
    }

    public function unrateAction(){
        $user_id = $this->getDI()->getShared("session")->get('user_id');
    
        $post_id = $this->request->getPost('post_id');

        $request = new UnrateRequest($user_id , $post_id);

        $response = $this->unrateService->execute($request);

        if($response->isError()){
            echo $response->getMessage();
        }
            
        return $this->response->redirect('/post');
    }

    public function ratingAction(){
        
        $user_id = $this->getDI()->getShared("session")->get('user_id');

        $request = new AddRatingRequest(
            $user_id,
            $this->request->getPost('rating'),
            $this->request->getPost('post_id')
        );

        $response = $this->addRatingService->execute($request);

        return $this->response->redirect('/post');
    }

    public function editAction(){

        if(!$this->security->checkToken()){
            echo "invalid csrf !!";
        }

        $request = new UpdatePostRequest(
            $this->request->getPost('post_id'),
            $this->request->getPost('title'),
            $this->request->getPost('description')
        );

        if ($this->request->hasFiles() == true) {
            $request->setFiles( $this->request->getUploadedFiles() );
        }
       
        $response = $this->updatePostService->execute($request);

        return $this->response->redirect('/post');
        
    }

    public function deleteAction($post_id){
        
        $response = $this->deletePostService->execute($post_id);

        return $this->response->redirect('/post');
    }

    public function createAction(){

        if(!$this->security->checkToken()){
            echo "invalid csrf !!";
        }

        $user_id = $this->getDI()->getShared("session")->get('user_id');
        $request = new CreatePostRequest(
            $user_id,
            $this->request->getPost('title'),
            $this->request->getPost('description')
        );

        if ($this->request->hasFiles() == true) {
            $request->setFiles( $this->request->getUploadedFiles() );
        }
       
        $response = $this->createPostService->execute($request);
    
        return $this->response->redirect('/post');
    }

}

